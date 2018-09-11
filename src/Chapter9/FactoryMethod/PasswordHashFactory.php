<?php
declare(strict_types=1);

namespace Acme\Chapter9\FactoryMethod;

class PasswordHashFactory extends HashFactoryMethod
{
    public const    WEAK    = 1;
    public const    ARGON2I = 2;

    protected const TYPES = [self::WEAK, self::ARGON2I];

    protected function generate($type): HashInterface
    {
        return new PasswordHash($type);
    }
}
