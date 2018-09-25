<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite;

use Acme\Chapter10\Composite\Exception\ClassNotFoundException;

final class Extending
{
    private $className;

    public function __construct(string $className)
    {
        $this->assertExtends($className);
        $this->className = $className;
    }

    public function classname(): string
    {
        return $this->className;
    }

    private function assertExtends(string $className): void
    {
        if (!class_exists($className)) {
            throw new ClassNotFoundException($className);
        }
    }
}
