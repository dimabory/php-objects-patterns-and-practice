<?php
declare(strict_types=1);

namespace Acme\Chapter8\Composition;

abstract class Rent
{
    private $rentStrategy;
    private $duration;
    private $price;

    public function __construct(float $price, int $duration, RentStrategy $rentStrategy)
    {
        $this->assertIsPositiveNumber($price, 'Price cannot be as negative number');
        $this->assertIsPositiveNumber($duration, 'Duration should be more than 0');

        $this->price        = $price;
        $this->rentStrategy = $rentStrategy;
        $this->duration     = $duration;
    }

    public function cost(): float
    {
        return $this->rentStrategy->cost($this);
    }

    public function getEndDatetime(): string
    {
        return $this->rentStrategy->getEndDatetime($this->duration);
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    private function assertIsPositiveNumber($value, string $message): void
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException($message);
        }
    }
}
