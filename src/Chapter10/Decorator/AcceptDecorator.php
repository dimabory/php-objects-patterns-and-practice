<?php

namespace Acme\Chapter10\Decorator;

class AcceptDecorator extends HttpHeaderDecorator
{
    public function fieldname(): string
    {
        return 'Accept';
    }
}
