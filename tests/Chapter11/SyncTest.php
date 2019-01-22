<?php

namespace Tests\Chapter11;

use Acme\Chapter11\Strategy\InterpreterContext;
use Acme\Chapter11\Strategy\Sync;
use PHPUnit\Framework\TestCase;

class SyncTest extends TestCase
{
    public function testExecuteWithVoidReturnType()
    {
        $sync = new Sync('printf("call sync test\n"); ');

        $execution = (new InterpreterContext($sync))->execute();

        $this->assertNull($execution, 'Execution should not return any type.');
    }

    public function testExecuteWithSpecifiedReturnType()
    {
        $sync = new Sync(
            <<<PHP
return 1;
PHP
        );

        $execution = (new InterpreterContext($sync))->execute();

        $this->assertEquals(1, $execution, 'Execution should return `1` as integer.');
    }
}
