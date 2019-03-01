<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class ConsumeDate
{
    private $date;
    public static function fromDateTime(\DateTimeInterface $date): ConsumeDate
    {
        return new self($date);
    }

    private function __construct(\DateTimeInterface $date)
    {
        $this->date = $date;
    }
}
