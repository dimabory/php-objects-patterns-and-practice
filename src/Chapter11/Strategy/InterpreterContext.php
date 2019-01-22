<?php

namespace Acme\Chapter11\Strategy;


class InterpreterContext
{
    private $execution;

    public function __construct(ExecutionStrategy $execution)
    {
        $this->execution = $execution;
    }

    public function execute()
    {
        printf("Starting execution %s...\n", get_class($this->execution));

        return $this->execution->execute();
    }
}
