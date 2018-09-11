<?php
declare(strict_types=1);

namespace Acme\Chapter9\Exception;

class IllegalSingletonInitiationException extends \Exception
{
    public function __construct(string $FQCN = \Singleton::class)
    {
        parent::__construct('You cannot initialize class '.$FQCN, 0, null);
    }
}
