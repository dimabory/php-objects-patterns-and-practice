<?php
declare(strict_types=1);

namespace Acme\Chapter9\AbstractFactory;

final class BinaryFile extends FileReader
{
    private const DEFAULT_DELIMETER = ' ';

    private $delimeter;

    public function __construct(string $filename, string $delimeter = null)
    {
        parent::__construct($filename);

        $this->delimeter = $delimeter ?: self::DEFAULT_DELIMETER;
    }

    public function asArray(): array
    {
        $buffer = explode(' ', $this->content);

        $content = array_reduce(
            $buffer,
            function ($content, $char) {
                $content .= \chr((int)hexdec($char));

                return $content;
            }
        );

        return explode($this->delimeter, $content);
    }

    protected static function ext(): string
    {
        return 'bin';
    }
}
