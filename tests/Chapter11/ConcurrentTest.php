<?php

namespace Tests\Chapter11;

use Acme\Chapter11\Strategy\Concurrent;
use Acme\Chapter11\Strategy\InterpreterContext;
use PHPUnit\Framework\TestCase;

class ConcurrentTest extends TestCase
{
    public function testExecute()
    {
        $this->expectException(\DomainException::class);

        (new InterpreterContext(new Concurrent('<php echo 1; ?>')))->execute();
    }
}
