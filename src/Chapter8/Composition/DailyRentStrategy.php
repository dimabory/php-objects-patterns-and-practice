<?php
declare(strict_types=1);

namespace Acme\Chapter8\Composition;

class DailyRentStrategy extends RentStrategy
{
    private const DAYS_TO_GET_DISCOUNT = 7;
    private const DISCOUNT             = 0.2;

    public function cost(Rent $rent): float
    {
        $cost = $rent->getPrice() * $rent->getDuration();
        if ($rent->getDuration() >= self::DAYS_TO_GET_DISCOUNT) {
            return $cost - round($cost * self::DISCOUNT);
        }

        return $cost;
    }

    public function getEndDatetime(int $duration): string
    {
        return (new \DateTime())->modify("+{$duration} day")->format('Y-m-d');
    }
}
