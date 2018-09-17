<?php
declare(strict_types=1);

namespace Acme\Chapter9\Exception;

class IllegalCloneCallException extends IllegalSingletonInitiationException
{
    protected $message = 'You cannot clone class';
}
