<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Types;

final class Collection extends AbstractType
{
    public function __construct(AbstractType ...$value)
    {
        parent::__construct($value);
    }

    public function __toString(): string
    {
        $value = array_map(
            function (AbstractType $scalar) {
                $element = $scalar->__toString();
                if ($scalar instanceof Heredoc) {
                    $element = rtrim($scalar->__toString(), ';').PHP_EOL;
                }

                return $element;
            },
            $this->value
        );

        return '['.implode(', ', $value).']';
    }
}
