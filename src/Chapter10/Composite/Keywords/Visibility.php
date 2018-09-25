<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Keywords;

use Acme\Chapter10\Composite\Exception\InvalidTypeException;

/**
 * @method static self public ()
 * @method static self protected ()
 * @method static self private ()
 */
final class Visibility extends AbstractKeyword
{
    private const PUBLIC    = 'public';
    private const PROTECTED = 'protected';
    private const PRIVATE   = 'private';

    protected static function validKeywords(): array
    {
        return [
            self::PUBLIC,
            self::PROTECTED,
            self::PRIVATE,
        ];
    }

    protected function throwInvalidKeywordException(string $keyword): void
    {
        throw new InvalidTypeException($keyword);
    }
}
