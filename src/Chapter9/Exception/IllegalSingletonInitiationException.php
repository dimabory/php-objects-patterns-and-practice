<?php
declare(strict_types=1);

namespace Acme\Chapter9\Exception;

use Acme\Chapter9\Singleton\Singleton;

class IllegalSingletonInitiationException extends \Exception
{
    protected $message = 'You cannot initialize class';

    public function __construct(string $FQCN = Singleton::class, string $message = null)
    {
        $errorMessage = ($message ?? $this->message).": {$FQCN}";

        parent::__construct($errorMessage, 0, null);
    }
}
