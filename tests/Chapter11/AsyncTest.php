<?php

namespace Tests\Chapter11;

use Acme\Chapter11\Strategy\Async;
use Acme\Chapter11\Strategy\InterpreterContext;
use PHPUnit\Framework\TestCase;

class AsyncTest extends TestCase
{
    public function testExecute()
    {
        $async     = new Async('printf("call func inside generator");');
        $execution = (new InterpreterContext($async))->execute();

        $this->assertIsIterable($execution);

        //while ($execution->next()) {
        //    $execution->current();
        //}
    }
}
