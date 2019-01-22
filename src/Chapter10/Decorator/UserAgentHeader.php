<?php

namespace Acme\Chapter10\Decorator;

class UserAgentHeader implements HttpHeader
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function fieldname(): string
    {
        return 'User-Agent';
    }

    public function __invoke(): array
    {
        return [$this->fieldname() => $this->value];
    }
}
