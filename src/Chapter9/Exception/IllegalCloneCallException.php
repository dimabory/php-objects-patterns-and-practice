<?php
declare(strict_types=1);

namespace Acme\Chapter9\Exception;

class IllegalCloneCallException extends IllegalSingletonInitiationException
{
    public function __construct(string $message = 'You cannot clone class', string $FQCN = \Singleton::class)
    {
        parent::__construct($message, $FQCN);
    }
}
