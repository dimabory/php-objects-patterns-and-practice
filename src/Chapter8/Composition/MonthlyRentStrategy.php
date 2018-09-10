<?php
declare(strict_types=1);

namespace Acme\Chapter8\Composition;

class MonthlyRentStrategy extends RentStrategy
{
    private const DISCOUNTS = [
        6  => 0.1,
        12 => 0.2,
        24 => 0.3,
    ];

    public function cost(Rent $rent): float
    {
        $discount = $this->getDiscount($rent);
        $cost     = $rent->getPrice() * $rent->getDuration();

        if ($discount) {
            return $cost - round($cost * $discount);
        }

        return $cost;
    }

    public function getDiscount(Rent $rent)
    {
        return array_reduce(
            array_keys(self::DISCOUNTS),
            function ($discount, $value) use ($rent) {
                if ($rent->getDuration() >= $value) {
                    $discount = self::DISCOUNTS[$value];
                }

                return $discount;
            },
            0
        );
    }

    public function getEndDatetime(int $duration): string
    {
        return (new \DateTime())->modify("+{$duration} month")->format('Y-m-d');
    }
}
