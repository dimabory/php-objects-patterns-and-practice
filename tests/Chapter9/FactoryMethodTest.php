<?php
declare(strict_types=1);

namespace Tests\Chapter9;

use Acme\Chapter9\Exception\EmptyStringException;
use Acme\Chapter9\Exception\InvalidHashTypeException;
use Acme\Chapter9\FactoryMethod\CryptFactory;
use Acme\Chapter9\FactoryMethod\HashFactoryMethod;
use Acme\Chapter9\FactoryMethod\PasswordHashFactory;
use PHPUnit\Framework\TestCase;

class FactoryMethodTest extends TestCase
{
    public function testCrypt()
    {
        $cryptFactory = new CryptFactory();

        $weak   = $cryptFactory->create(CryptFactory::WEAK)->encode('');
        $strong = $cryptFactory->create(CryptFactory::STRONG)->encode('1');

        $this->assertNotEmpty($weak);
        $this->assertNotEmpty($strong);

        $this->assertTrue(hash_equals($weak, crypt('', $weak)));
    }

    public function testPasswordHash()
    {
        $pwdHashFactory = new PasswordHashFactory();

        $defaultPwd = $pwdHashFactory->create(PasswordHashFactory::WEAK)->encode('');
        $argoni2Pwd = $pwdHashFactory->create(PasswordHashFactory::ARGON2I)->encode('1');

        $this->assertNotEmpty($defaultPwd);
        $this->assertNotEmpty($argoni2Pwd);
        $this->assertStringStartsWith('$argon2i', $argoni2Pwd);
    }

    public function testArgon2iEmptyStringException()
    {
        $this->expectException(EmptyStringException::class);

        (new PasswordHashFactory())->create(PasswordHashFactory::ARGON2I)->encode('');
    }

    /**
     * @dataProvider incorrectTypeDataProvider
     */
    public function testIncorrectType(HashFactoryMethod $factoryMethod, $type)
    {
        $this->expectException(InvalidHashTypeException::class);

        $factoryMethod->create($type);
    }

    public function incorrectTypeDataProvider(): array
    {
        return [
            [new PasswordHashFactory(), HashFactoryMethod::STRONG],
            [new PasswordHashFactory(), 0],
            [new PasswordHashFactory(), '12'],
            [new CryptFactory(), PasswordHashFactory::ARGON2I],
            [new CryptFactory(), 'null'],
            [new CryptFactory(), 0],
        ];
    }
}
