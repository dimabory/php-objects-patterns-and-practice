<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Exception;

class InvalidTypeException extends \Exception
{
    public function __construct(string $value)
    {
        parent::__construct("Invalid type: {$value}");
    }
}
