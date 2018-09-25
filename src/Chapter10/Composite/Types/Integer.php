<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Types;

/**
 * @link http://php.net/manual/en/language.types.integer.php
 */
final class Integer extends AbstractType
{
    public function __construct(int $value)
    {
        parent::__construct($value);
    }

    public function __toString(): string
    {
        return sprintf('%d', $this->value);
    }
}
