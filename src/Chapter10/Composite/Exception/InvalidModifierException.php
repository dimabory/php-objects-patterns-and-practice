<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Exception;

class InvalidModifierException extends \Exception
{
    public function __construct($name)
    {
        parent::__construct("Invalid modifier ${name}");
    }
}
