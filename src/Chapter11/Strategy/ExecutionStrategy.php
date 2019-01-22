<?php

namespace Acme\Chapter11\Strategy;

abstract class ExecutionStrategy
{
    protected $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    abstract public function execute();
}
