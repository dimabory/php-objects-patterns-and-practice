<?php

namespace Acme\Chapter10\Decorator;

class CacheControlDecorator extends HttpHeaderDecorator
{
    public function fieldname(): string
    {
        return 'Cache-Control';
    }
}
