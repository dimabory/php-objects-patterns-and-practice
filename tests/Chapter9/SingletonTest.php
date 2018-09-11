<?php
declare(strict_types=1);

namespace Tests\Chapter9;

use Acme\Chapter9\Exception\IllegalCloneCallException;
use Acme\Chapter9\Exception\IllegalSingletonInitiationException;
use Acme\Chapter9\Exception\IllegalWakeupCallException;
use Acme\Chapter9\Singleton\Singleton;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{
    public function testGetInstance()
    {
        $first  = Singleton::getInstance();
        $second = Singleton::getInstance();

        $second->setProperty('1', 1);
        $first->setProperty('2', 1);

        $this->assertSame($first, $second);
    }

    public function testWakeup()
    {
        $this->expectException(IllegalWakeupCallException::class);

        unserialize(serialize(Singleton::getInstance()));
    }

    public function testClone()
    {
        $this->expectException(IllegalCloneCallException::class);

        clone Singleton::getInstance();
    }

    public function testConstruct()
    {
        $this->expectException(IllegalSingletonInitiationException::class);
        new Singleton();
    }
}
