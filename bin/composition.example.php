#!/usr/bin/env php

<?php

use Acme\Chapter8\Composition\{
    DailyRentStrategy,
    MonthlyRentStrategy,
    Rent};

require_once 'autoload.php';

try {
    $rents = [
        'car 1'     => new \Acme\Chapter8\Composition\RentACar(100, 10, new DailyRentStrategy()),
        'car 2'     => new \Acme\Chapter8\Composition\RentACar(100, 25, new MonthlyRentStrategy()),
        'bicycle 2' => new \Acme\Chapter8\Composition\RentABicycle(10, 2, new MonthlyRentStrategy()),
    ];


    foreach ($rents as $key => $rent) {
        /** @var $rent Rent */
        echo "rent a {$key} until {$rent->getEndDatetime()}: {$rent->cost()}".PHP_EOL;
    }
} catch (InvalidArgumentException $argumentException) {
    exit($argumentException->getMessage());
}

