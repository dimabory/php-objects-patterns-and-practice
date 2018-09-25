<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Exception;

class InvalidComponentVisibilityException extends \Exception
{
    protected $message = 'Invalid visibility: %s';

    public function __construct(string $value)
    {
        parent::__construct(sprintf($this->message, $value));
    }
}
