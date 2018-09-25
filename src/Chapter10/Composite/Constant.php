<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite;

use Acme\Chapter10\Composite\Keywords\Visibility;
use Acme\Chapter10\Composite\Types\AbstractType;

final class Constant extends AbstractComponent
{
    private $visibility;

    private $value;

    public function __construct(string $name, Visibility $visibility, AbstractType $value)
    {
        parent::__construct($name);

        $this->visibility = $visibility;
        $this->value      = $value;
    }

    public function name(): string
    {
        return strtoupper(parent::name());
    }

    public function build(): string
    {
        return <<<NOTATION
    {$this->visibility} const {$this->name()} = {$this->value};
NOTATION;
    }
}
