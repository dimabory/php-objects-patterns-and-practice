<?php
declare(strict_types=1);

namespace Acme\Chapter9\Exception;

class FileNotFoundException extends \Exception
{
    public function __construct(string $path)
    {
        parent::__construct("File not found {$path}");
    }
}
