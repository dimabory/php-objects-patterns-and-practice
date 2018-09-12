<?php
declare(strict_types=1);

namespace Acme\Chapter9\AbstractFactory;

final class JsonFile extends FileReader
{
    public function asArray(): array
    {
        return json_decode($this->content, true);
    }

    protected static function ext(): string
    {
        return 'json';
    }
}
