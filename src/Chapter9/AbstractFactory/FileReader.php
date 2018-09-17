<?php
declare(strict_types=1);

namespace Acme\Chapter9\AbstractFactory;

use Acme\Chapter9\Exception\FileNotFoundException;
use Acme\Chapter9\Exception\GetContentException;

abstract class FileReader
{
    /**
     * @var string
     */
    protected $content;

    public function __construct(string $filename)
    {
        $ext  = static::ext();
        $path = dirname(__FILE__)."/resources/{$filename}.{$ext}";

        $this->assertFileExists($path);

        $this->content = $this->getContents($path);
    }

    private function getContents(string $path): string
    {
        $contents = file_get_contents($path);

        if (false === $contents) {
            throw new GetContentException("Cannot read file {$path}");
        }

        return $contents;
    }

    private function assertFileExists(string $path)
    {
        if (!file_exists($path)) {
            throw new FileNotFoundException($path);
        }
    }

    abstract public function asArray(): array;

    abstract protected static function ext(): string;
}
