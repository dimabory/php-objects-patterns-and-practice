<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Types;

/**
 * @link http://php.net/manual/en/language.types.float.php
 */
final class Decimal extends AbstractType
{
    public function __construct(float $value)
    {
        parent::__construct($value);
    }

    public function __toString(): string
    {
        return sprintf('%g', $this->value);
    }
}
