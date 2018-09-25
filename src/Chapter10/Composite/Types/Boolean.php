<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Types;

/**
 * @link http://php.net/manual/en/language.types.boolean.php
 */
final class Boolean extends AbstractType
{
    public function __construct(bool $value)
    {
        parent::__construct($value);
    }

    public function __toString(): string
    {
        return (string)json_encode($this->value);
    }
}
