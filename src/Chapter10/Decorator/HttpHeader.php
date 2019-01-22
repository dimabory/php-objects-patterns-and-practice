<?php

namespace Acme\Chapter10\Decorator;

interface HttpHeader
{
    public function fieldname(): string;

    public function __invoke(): array;
}
