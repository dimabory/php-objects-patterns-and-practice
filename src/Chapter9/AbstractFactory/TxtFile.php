<?php
declare(strict_types=1);

namespace Acme\Chapter9\AbstractFactory;

final class TxtFile extends FileReader
{
    private const DEFAULT_DELIMETER = PHP_EOL;

    private $delimeter;

    public function __construct(string $filename, string $delimeter = null)
    {
        parent::__construct($filename);

        $this->delimeter = $delimeter ?: self::DEFAULT_DELIMETER;
    }

    public function asArray(): array
    {
        return explode($this->delimeter, $this->content);
    }

    protected static function ext(): string
    {
        return 'txt';
    }
}
