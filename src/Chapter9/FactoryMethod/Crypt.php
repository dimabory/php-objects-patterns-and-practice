<?php
declare(strict_types=1);

namespace Acme\Chapter9\FactoryMethod;

class Crypt implements HashInterface
{
    private $salt;

    public function __construct(string $salt = '')
    {
        $this->salt = $salt;
    }

    public function encode(string $str): string
    {
        return \crypt($str, $this->salt);
    }
}
