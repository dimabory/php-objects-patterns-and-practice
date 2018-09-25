<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite;

use Acme\Chapter10\Composite\Keywords\Typehinting;
use Acme\Chapter10\Composite\Keywords\Visibility;
use Acme\Chapter10\Composite\Types\AbstractType;

final class Attribute extends AbstractComponent
{
    /**
     * @var Visibility
     */
    private $visibility;

    /**
     * @var bool
     */
    private $isStatic;

    /**
     * @var AbstractType|null
     */
    private $defaultValue;

    public function __construct(
        string $name,
        Visibility $visibility = null,
        bool $isStatic = false,
        AbstractType $defaultValue = null
    ) {
        parent::__construct($name);

        $this->visibility   = $visibility ?? Visibility::public();
        $this->isStatic     = $isStatic;
        $this->defaultValue = $defaultValue;
    }

    public function build(): string
    {
        return <<<NOTATION
    {$this->modifier()} \${$this->name()}{$this->defaultValue()};
NOTATION;
    }

    public function modifier(): string
    {
        return $this->visibility.($this->isStatic ? ' static' : '');
    }

    public function defaultValue(): string
    {
        return $this->defaultValue ? " = {$this->defaultValue}" : '';
    }

    public function toArgument(?Typehinting $type = null): Argument
    {
        return new Argument($this->name(), $type);
    }
}
