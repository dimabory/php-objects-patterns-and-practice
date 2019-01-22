<?php

namespace Acme\Chapter10\Decorator;

class AcceptEncodingDecorator extends HttpHeaderDecorator
{
    public function fieldname(): string
    {
        return 'Accept-Encoding';
    }
}
