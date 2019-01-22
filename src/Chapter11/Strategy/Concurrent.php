<?php

namespace Acme\Chapter11\Strategy;

class Concurrent extends ExecutionStrategy
{
    public function execute(): void
    {
        throw new \DomainException(sprintf('Not supported %s', self::class));
    }
}
