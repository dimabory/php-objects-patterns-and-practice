<?php
declare(strict_types=1);

namespace Acme\Chapter9\Exception;

class IllegalSingletonInitiationException extends \Exception
{
    public function __construct($message = 'You cannot initialize class', string $FQCN = \Singleton::class)
    {
        parent::__construct("{$message} {$FQCN}", 0, null);
    }
}
