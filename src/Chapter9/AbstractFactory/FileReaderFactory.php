<?php
declare(strict_types=1);

namespace Acme\Chapter9\AbstractFactory;

class FileReaderFactory
{
    public function createJsonReader(string $filename): JsonFile
    {
        return new JsonFile($filename);
    }

    public function createTxtReader(string $filename, string $delimeter = null): TxtFile
    {
        return new TxtFile($filename, $delimeter);
    }

    public function createBinaryReader(string $filename, string $delimeter = null): BinaryFile
    {
        return new BinaryFile($filename, $delimeter);
    }
}
