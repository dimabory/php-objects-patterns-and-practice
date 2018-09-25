<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Types;

/**
 * @link http://php.net/manual/en/language.types.string.php#language.types.string.syntax.nowdoc
 */
final class Nowdoc extends Heredoc
{
    public function __toString(): string
    {
        return <<<NOWDOC
<<<'EOT'
{$this->value}
EOT
NOWDOC;
    }
}
