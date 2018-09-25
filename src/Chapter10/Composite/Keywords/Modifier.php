<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Keywords;

use Acme\Chapter10\Composite\Exception\InvalidModifierException;

/**
 * @method static self abstract ()
 * @method static self final ()
 */
final class Modifier extends AbstractKeyword
{
    private const ABSTRACT_KEYWORD = 'abstract';
    private const FINAL_KEYWORD    = 'final';

    public function isAbstract(): bool
    {
        return $this->keyword === self::ABSTRACT_KEYWORD;
    }

    public function isFinal(): bool
    {
        return $this->keyword === self::FINAL_KEYWORD;
    }

    protected static function validKeywords(): array
    {
        return [
            self::ABSTRACT_KEYWORD,
            self::FINAL_KEYWORD,
        ];
    }

    protected function throwInvalidKeywordException(string $keyword): void
    {
        throw new InvalidModifierException($keyword);
    }
}
