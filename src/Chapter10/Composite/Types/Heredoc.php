<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Types;

/**
 * @link http://php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc
 */
class Heredoc extends AbstractType
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    public function __toString(): string
    {
        return <<<HEREDOC
<<<EOT
{$this->value}
EOT
HEREDOC;
    }
}
