<?php
declare(strict_types=1);

namespace Tests\Chapter9;

use Acme\Chapter9\Exception\IllegalCloneCallException;
use Acme\Chapter9\Exception\RepositoryNotFoundException;
use Acme\Chapter9\Prototype\Account;
use Acme\Chapter9\Prototype\Repository;
use PHPUnit\Framework\TestCase;

class PrototypeTest extends TestCase
{
    public function testPrototype()
    {
        $iAm    = new Account('im');
        $phpSrc = new Repository($iAm, 'php-src');
        $phpFig = new Repository($iAm, 'php-fig');

        $iAm->addRepository($phpSrc);
        $iAm->addRepository($phpFig);
        $phpSrc->star()->star();

        $youAre     = new Account('you-are');
        $phpSrcFork = clone $iAm->getRepository('php-src');

        $this->assertNull($phpSrcFork->getOwner());
        $this->assertEmpty($phpSrcFork->getStars());

        $youAre->addRepository($phpSrcFork);
        $youAre->addRepository($phpFig);

        $phpSrcFork->star();

        $phpFigFork = $youAre->getRepository('php-fig');
        $phpFigFork->star();

        $allRepositories = [$phpSrc, $phpFig, $phpSrcFork, $phpFigFork];

        self::assertEquals(
            [2, 0, 1, 1],
            $this->mapRepositoriesAndCallGetter($allRepositories, 'getStars'),
            'One of the repositories has incorrect `stars` value'
        );
        self::assertEquals(
            ['im/php-src', 'im/php-fig', 'you-are/php-src', 'you-are/php-fig',],
            $this->mapRepositoriesAndCallGetter($allRepositories, 'fullName'),
            'One of the repositories has incorrect `fullname` value'
        );
        self::assertEquals(
            ['PUBLIC', 'PUBLIC', 'FORKED', 'FORKED'],
            $this->mapRepositoriesAndCallGetter($allRepositories, 'getType'),
            'One of the repositories has incorrect `type`'
        );

        self::assertSame($phpSrc->getCreatedAt(), $phpSrcFork->getCreatedAt());
    }

    public function testIllegalClonePrototypeException()
    {
        $this->expectException(IllegalCloneCallException::class);
        
        $private = new Repository(new Account('im'), 'php-src', Repository::PRIVATE_TYPE);
        (function () use ($private) {
            return clone $private;
        })();
    }

    public function testRepositoryNotFoundException()
    {
        $this->expectException(RepositoryNotFoundException::class);

        $acc  = new Account('bla-bla');
        $repo = new Repository($acc, 'bla-bla');
        $acc->addRepository($repo);
        $acc->getRepository('^_^');
    }

    private function mapRepositoriesAndCallGetter(array $repositories, string $method)
    {
        return array_map(
            function (Repository $repository) use ($method) {
                return $repository->{$method}();
            },
            $repositories
        );
    }
}
