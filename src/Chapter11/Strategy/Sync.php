<?php

namespace Acme\Chapter11\Strategy;

class Sync extends ExecutionStrategy
{
    public function execute()
    {
        try {
            return eval($this->code);
        } catch (\Throwable $exception) {
            throw new \LogicException(
                sprintf('Cannot execute code due to %s', $exception->getMessage()), $exception->getCode(), $exception
            );
        }
    }
}
