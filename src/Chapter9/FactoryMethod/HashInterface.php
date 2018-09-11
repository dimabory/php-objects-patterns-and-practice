<?php
declare(strict_types=1);

namespace Acme\Chapter9\FactoryMethod;

interface HashInterface
{
    public function encode(string $str): string;
}
