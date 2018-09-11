<?php
declare(strict_types=1);

namespace Tests\Chapter8;

use Acme\Chapter8\Composition\{
    DailyRentStrategy,
    MonthlyRentStrategy,
    Rent,
    RentABicycle,
    RentACar};
use PHPUnit\Framework\TestCase;

class RentTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRent(Rent $rent, float $expectedCost, \DateTimeImmutable $expectedEndDatetime)
    {
        $this->assertSame($rent->cost(), $expectedCost);
        $this->assertSame($rent->getEndDatetime(), $expectedEndDatetime->format('Y-m-d'));
    }

    /**
     * @dataProvider expectExceptionDataProvider
     */
    public function testException(...$args)
    {
        $this->expectException(\InvalidArgumentException::class);

        new RentABicycle(...$args);
    }

    public function dataProvider(): array
    {
        $now = new \DateTimeImmutable();

        return [
            [new RentACar(100.0, 1, new DailyRentStrategy()), 100.0, $now->modify('+1 day')],
            [new RentACar(100.0, 7, new DailyRentStrategy()), 560.0, $now->modify('+7 day')],
            [new RentACar(100.0, 14, new DailyRentStrategy()), 1120.0, $now->modify('+14 day')],
            [new RentACar(100.0, 31, new DailyRentStrategy()), 2480.0, $now->modify('+31 day')],
            [new RentABicycle(310.0, 1, new MonthlyRentStrategy()), 310.0, $now->modify('+1 month')],
            [new RentABicycle(310.0, 6, new MonthlyRentStrategy()), 1674.0, $now->modify('+6 month')],
            [
                new RentABicycle(310.0, 12, new MonthlyRentStrategy()),
                2976.0,
                $now->modify('+12 month'),
            ],
            [
                new RentABicycle(310.0, 24, new MonthlyRentStrategy()),
                5208.0,
                $now->modify('+24 month'),
            ],
        ];
    }

    public function expectExceptionDataProvider(): array
    {
        return [
            [0, 0, new DailyRentStrategy()],
            [0, 1, new MonthlyRentStrategy()],
            [1, 0, new DailyRentStrategy()],
            [-1, 2, new MonthlyRentStrategy()],
            [2, -1, new DailyRentStrategy()],
            [-2, -1, new MonthlyRentStrategy()],
        ];
    }
}
