<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite;

use Acme\Chapter10\Composite\Exception\InvalidNameException;

abstract class AbstractComponent
{
    private $name;

    public function __construct(string $name)
    {
        $this->assertName($name);
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    /**
     * @link http://php.net/manual/en/language.oop5.basic.php
     * The class name can be any valid label, provided it is not a PHP reserved word. A valid class name starts with a
     * letter or underscore, followed by any number of letters, numbers, or underscores. As a regular expression, it
     * would be expressed thus: ^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$.
     *
     * @param string $value
     *
     * @throws InvalidNameException
     */
    private function assertName(string $value): void
    {
        if (!preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $value)) {
            throw new InvalidNameException($value);
        }
    }

    abstract public function build(): string;
}
