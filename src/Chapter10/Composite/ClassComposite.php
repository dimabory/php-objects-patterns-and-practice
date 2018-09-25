<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite;

use Acme\Chapter10\Composite\Keywords\Modifier;

final class ClassComposite extends AbstractComponent
{
    /**
     * @var AbstractComponent[]
     */
    private $elements = [];

    /**
     * @var string|null
     */
    private $namespace;

    /**
     * @var Modifier|null
     */
    private $modifier;

    /**
     * @var Extending|null
     */
    private $extends;

    /**
     * @var Implementing|null
     */
    private $implements;

    public function __construct(
        string $name,
        string $namespace = null,
        Modifier $modifier = null,
        Extending $extends = null,
        Implementing $implements = null
    ) {
        parent::__construct($name);
        $this->namespace  = $namespace;
        $this->modifier   = $modifier;
        $this->extends    = $extends;
        $this->implements = $implements;
    }

    public function name(): string
    {
        return ucfirst(parent::name());
    }

    public function addElement(AbstractComponent $component): void
    {
        $this->elements [spl_object_id($component)] = $component;
    }

    public function removeElement(AbstractComponent $component): void
    {
        unset($this->elements[spl_object_id($component)]);
    }

    public function hasElement(AbstractComponent $component): bool
    {
        return array_key_exists(spl_object_id($component), $this->elements);
    }

    public function build(): string
    {
        $this->beforeBuild();

        return <<<NOTATION
{$this->namespace()}{$this->modifier()}class {$this->name()}{$this->extends()}{$this->implements()}
{
{$this->body()}
}

NOTATION;
    }

    private function beforeBuild(): void
    {
        if ($this->implements) {
            $this->addInterfaceMethods(
                array_merge(
                    ... array_map(
                        'get_class_methods',
                        $this->implements->getInterfaces()
                    )
                )
            );
        }
    }

    private function addInterfaceMethods(array $methods): void
    {
        foreach ($methods as $method) {
            $this->addElement(new Method($method));
        }
    }

    private function namespace(): string
    {
        return $this->namespace ? "namespace {$this->namespace};".str_repeat(PHP_EOL, 2) : '';
    }

    private function modifier(): string
    {
        return $this->modifier ? "{$this->modifier} " : '';
    }

    private function extends(): string
    {
        return $this->extends ? " extends {$this->extends->classname()}" : '';
    }

    private function implements(): string
    {
        return $this->implements ? ' implements '.implode(', ', $this->implements->getInterfaces()) : '';
    }

    private function body(): string
    {
        return substr(
            PHP_EOL.array_reduce(
                $this->elements,
                function ($body, AbstractComponent $component) {
                    return $body.$component->build().str_repeat(PHP_EOL, 2);
                },
                ''
            ),
            0,
            -1
        );
    }
}
