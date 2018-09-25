<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Types;

use Acme\Chapter10\Composite\Exception\ClassNotFoundException;

/**
 * @method static self boolean(bool $value)
 * @method static self collection(self ...$value)
 * @method static self decimal(float $value)
 * @method static self heredoc(string $value)
 * @method static self integer(int $value)
 * @method static self nowdoc(string $value)
 * @method static self str(string $value)
 */
abstract class AbstractType
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public static function __callStatic($name, $arguments): self
    {
        $className = 'Acme\Chapter10\Composite\Types\\'.ucfirst($name);
        if (!class_exists($className)) {
            throw new ClassNotFoundException($className);
        }

        return new $className(...$arguments);
    }

    abstract public function __toString(): string;
}
