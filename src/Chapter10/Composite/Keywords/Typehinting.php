<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Keywords;

use Acme\Chapter10\Composite\Exception\ClassNotFoundException;
use Acme\Chapter10\Composite\Exception\InvalidTypeException;

/**
 * @method static self bool ()
 * @method static self string ()
 * @method static self int ()
 * @method static self array()
 * @method static self float ()
 * @method static self iterable ()
 * @method static self object ()
 * @method static self callable ()
 */
class Typehinting extends AbstractKeyword
{
    private const VALID_TYPES = ['bool', 'string', 'int', 'array', 'float', 'string', 'iterable', 'object', 'callable'];

    public static function __callStatic($name, $arguments): self
    {
        return new self($name);
    }

    public static function withClass(string $name): self
    {
        if (!class_exists($name)) {
            throw new ClassNotFoundException($name);
        }

        return new class("\\{$name}") extends Typehinting
        {
            protected function throwInvalidKeywordException(string $keyword): void
            {
            }
        };
    }

    protected static function validKeywords(): array
    {
        return self::VALID_TYPES;
    }

    protected function throwInvalidKeywordException(string $keyword): void
    {
        throw new InvalidTypeException($keyword);
    }
}
