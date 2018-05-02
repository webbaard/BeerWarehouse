<?php
declare(strict_types=1);

namespace BeerWarehouse\Domain\Beer\ValueObject;

final class BoughtDate
{
    private $date;
    public static function fromDateTime(\DateTimeInterface $date): BoughtDate
    {
        return new self($date);
    }

    private function __construct(\DateTimeInterface $date)
    {
        $this->date = $date;
    }
}
