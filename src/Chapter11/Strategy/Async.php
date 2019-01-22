<?php

namespace Acme\Chapter11\Strategy;

class Async extends ExecutionStrategy
{
    public function execute(): \Generator
    {
        yield eval($this->code);
    }
}
