<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite\Keywords;

abstract class AbstractKeyword
{
    protected $keyword;

    public function __construct(string $keyword)
    {
        $this->assertKeyword($keyword);
        $this->keyword = $keyword;
    }

    protected function assertKeyword(string $keyword): void
    {
        if (!\in_array($keyword, static::validKeywords(), true)) {
            $this->throwInvalidKeywordException($keyword);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        return new static($name);
    }

    public function __toString(): string
    {
        return $this->keyword;
    }

    abstract protected static function validKeywords(): array;

    abstract protected function throwInvalidKeywordException(string $keyword): void;
}
