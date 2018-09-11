<?php
declare(strict_types=1);

namespace Acme\Chapter9\Singleton;


use Acme\Chapter9\Exception\IllegalCloneCallException;
use Acme\Chapter9\Exception\IllegalSingletonInitiationException;
use Acme\Chapter9\Exception\IllegalWakeupCallException;

/**
 * THIS IS CONSIDERED TO BE AN ANTI-PATTERN!
 * FOR BETTER TESTABILITY AND MAINTAINABILITY USE DEPENDENCY INJECTION!
 */
class Singleton
{
    private static $instance;

    private $props = [];

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getProperty(string $key)
    {
        if ($this->props[$key] ?? false) {
            return $this->props[$key];
        }

        return null;
    }

    public function setProperty(string $key, $value): self
    {
        $this->props[$key] = $value;

        return $this;
    }

    /**
     * encapsulate this method as PRIVATE and remove useless body
     * or
     * leave as is to run tests correctly
     * @see \Tests\Chapter9\SingletonTest::testConstruct()
     */
    public function __construct()
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $class     = $backtrace[1]['class'];
        $function  = $backtrace[1]['function'];
        if ($class !== self::class && $function !== 'getInstance') {
            throw new IllegalSingletonInitiationException();
        }
    }

    /**
     * encapsulate this method as PRIVATE
     * to prevent from being unserialized (which would create a second instance of it)
     *
     * 2. leave as is to run tests correctly
     * @see \Tests\Chapter9\SingletonTest::testClone()
     */
    public function __clone()
    {
        throw new IllegalCloneCallException();
    }

    /**
     * 1. encapsulate this method as PRIVATE
     * to prevent from being unserialized (which would create a second instance of it)
     *
     * 2. leave as is to run tests correctly
     * @see \Tests\Chapter9\SingletonTest::testWakeup()
     */
    public function __wakeup()
    {
        throw new IllegalWakeupCallException();
    }
}
