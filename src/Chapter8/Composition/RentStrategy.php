<?php
declare(strict_types=1);

namespace Acme\Chapter8\Composition;

abstract class RentStrategy
{
    abstract public function cost(Rent $rent): float;

    abstract public function getEndDatetime(int $duration): string;
}
