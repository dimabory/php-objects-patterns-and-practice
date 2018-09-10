<?php
declare(strict_types=1);

namespace Acme\Chapter8\Composition;

class HourlyRentStrategy extends RentStrategy
{
    public function cost(Rent $rent): float
    {
        // TODO: Implement cost() method.
    }

    public function getEndDatetime(int $duration): string
    {
        // TODO: Implement getEndDatetime() method.
    }
}
