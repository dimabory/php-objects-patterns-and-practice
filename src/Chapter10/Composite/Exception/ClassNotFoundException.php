<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Exception;

class ClassNotFoundException extends \Exception
{
    public function __construct(string $name)
    {
        parent::__construct("Class {$name} not found");
    }
}
