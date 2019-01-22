<?php

namespace Acme\Chapter10\Decorator;

abstract class HttpHeaderDecorator implements HttpHeader
{
    protected $header;

    private $value;

    public function __construct(HttpHeader $header, string $value)
    {
        $this->header = $header;
        $this->value  = $value;
    }

    abstract public function fieldname(): string;

    public function __invoke(): array
    {
        return array_replace_recursive(
            ($this->header)(),
            [$this->fieldname() => $this->value]
        );
    }
}
