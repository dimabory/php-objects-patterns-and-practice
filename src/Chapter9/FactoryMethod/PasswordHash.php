<?php
declare(strict_types=1);

namespace Acme\Chapter9\FactoryMethod;

use Acme\Chapter9\Exception\EmptyStringException;

class PasswordHash implements HashInterface
{
    private const PWD_ARGON2I = 2;

    private $algo;

    private $options;

    public function __construct(int $algo = PASSWORD_DEFAULT, array $options = [])
    {
        $this->algo    = $algo;
        $this->options = $options;
    }

    public function encode(string $str): string
    {
        return self::PWD_ARGON2I === $this->algo
            ? $this->argon2iPolyfill($str)
            : password_hash(
                $str,
                $this->algo,
                $this->options
            );
    }

    public function argon2iPolyfill(string $str): string
    {
        $this->assertEmptyStr($str);

        if (!\extension_loaded('sodium')) {
            $prefix  = '$argon2i';
            $pwdAlgo = PASSWORD_DEFAULT;
        }

        return ($prefix ?? '').password_hash($str, $pwdAlgo ?? $this->algo, $this->options);
    }

    private function assertEmptyStr(string $str): void
    {
        if (!$str) {
            throw new EmptyStringException();
        }
    }
}
