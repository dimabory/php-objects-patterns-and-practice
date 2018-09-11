<?php
declare(strict_types=1);

namespace Acme\Chapter9\Exception;

class EmptyStringException extends \InvalidArgumentException
{
    public function __construct(string $message = 'Password cannot be empty')
    {
        parent::__construct($message);
    }
}
