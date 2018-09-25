<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite;

use Acme\Chapter10\Composite\Keywords\Typehinting;
use Acme\Chapter10\Composite\Types\AbstractType;

final class Argument
{
    private $name;
    private $type;
    private $defaultValue;

    public function __construct(string $name, ?Typehinting $type = null, ?AbstractType $defaultValue = null)
    {
        $this->name         = $name;
        $this->type         = $type;
        $this->defaultValue = $defaultValue;
    }

    public function type(): string
    {
        return $this->type ? "{$this->type->__toString()} " : '';
    }

    public function defaultValue(): string
    {
        return $this->defaultValue ? " = {$this->defaultValue}" : '';
    }

    public function __toString(): string
    {
        return "{$this->type()}\${$this->name}{$this->defaultValue()}";
    }
}
