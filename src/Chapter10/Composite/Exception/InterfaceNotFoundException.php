<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Exception;

class InterfaceNotFoundException extends \Exception
{
    public function __construct(string $name)
    {
        parent::__construct("Interface {$name} not found");
    }
}
