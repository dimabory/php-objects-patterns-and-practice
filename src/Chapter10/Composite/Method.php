<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite;

use Acme\Chapter10\Composite\Keywords\{
    Modifier,
    Typehinting,
    Visibility};

final class Method extends AbstractComponent
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
     * @var Argument[]
     */
    private $params;

    /**
     * @var Typehinting|null
     */
    private $returnType;

    /**
     * @var Modifier|null
     */
    private $modifier;

    public function __construct(
        string $name,
        Visibility $visibility = null,
        bool $isStatic = false,
        Modifier $modifier = null,
        array $params = [],
        Typehinting $returnType = null
    ) {
        parent::__construct($name);

        $this->visibility = $visibility ?? Visibility::public();
        $this->isStatic   = $isStatic;
        $this->modifier   = $modifier;
        $this->returnType = $returnType;
        $this->params     = (function (Argument ...$params) {
            return $params;
        })(
            ...$params
        );
    }

    public function build(): string
    {
        return <<<NOTATION
    {$this->modifier()}{$this->visibility}{$this->static()} function {$this->name()}({$this->args()}){$this->return()}{$this->body()}
NOTATION;
    }

    private function modifier(): string
    {
        return $this->modifier ? $this->modifier.' ' : '';
    }

    private function static(): string
    {
        return $this->isStatic ? ' static' : '';
    }

    private function args(): string
    {
        return implode(', ', array_map('\strval', $this->params));
    }

    private function return(): string
    {
        return $this->returnType ? ": {$this->returnType}" : '';
    }

    private function body(): string
    {
        return !($this->modifier && $this->modifier->isAbstract()) ? <<<BODY

    {
        // TODO: Implement {$this->name()}() method.
    }
BODY
            : ';';
    }
}
