<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\ValueObject;

final class RemovedDate
{
    private $date;
    public static function fromDateTime(\DateTimeInterface $date): RemovedDate
    {
        return new self($date);
    }

    private function __construct(\DateTimeInterface $date)
    {
        $this->date = $date;
    }

    public function toString()
    {
        return $this->date->format("c");
    }
}
