<?php
declare(strict_types=1);

namespace Acme\Chapter9\AbstractFactory;

use Acme\Chapter9\Exception\FileNotFoundException;

abstract class FileReader
{
    /**
     * @var string|null
     */
    protected $content;

    public function __construct(string $filename)
    {
        $ext  = static::ext();
        $path = dirname(__FILE__)."/resources/{$filename}.{$ext}";

        if (!file_exists($path)) {
            throw new FileNotFoundException($path);
        }

        $this->content = file_get_contents($path);
    }

    abstract public function asArray(): array;

    abstract protected static function ext(): string;
}
