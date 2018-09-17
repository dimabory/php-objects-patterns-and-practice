<?php
declare(strict_types=1);

namespace Acme\Chapter9\Exception;

class IllegalWakeupCallException extends IllegalSingletonInitiationException
{
    protected $message = 'You cannot deserialize class';
}
