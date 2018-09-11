<?php
declare(strict_types=1);

namespace Acme\Chapter9\Exception;

class InvalidHashTypeException extends \InvalidArgumentException
{
    public function __construct($type)
    {
        parent::__construct("Invalid hash type `{$type}``");
    }
}
