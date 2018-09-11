<?php
declare(strict_types=1);

namespace Acme\Chapter9\FactoryMethod;

use Acme\Chapter9\Exception\InvalidHashTypeException;

abstract class HashFactoryMethod
{
    public const STRONG = 'STRONG';
    public const WEAK   = 'WEAK';

    protected const TYPES = [self::STRONG, self::WEAK];

    abstract protected function generate($type): HashInterface;

    public function create($type): HashInterface
    {
        $this->assertType($type);

        return $this->generate($type);
    }

    protected function assertType($type): void
    {
        if (!\in_array($type, static::TYPES, true)) {
            throw new InvalidHashTypeException($type);
        }
    }
}
