<?php
declare(strict_types=1);

namespace Acme\Chapter9\FactoryMethod;

class CryptFactory extends HashFactoryMethod
{
    protected function generate($type): HashInterface
    {
        return !self::STRONG ? new Crypt() : new Crypt(substr(base64_encode(random_bytes(17)), 0, 22));
    }
}
