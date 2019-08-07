<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class BoughtDate
{
    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * @param \DateTimeInterface $date
     * @return BoughtDate
     */
    public static function fromDateTime(\DateTimeInterface $date): BoughtDate
    {
        return new self($date);
    }

    /**
     * BoughtDate constructor.
     * @param \DateTimeInterface $date
     */
    private function __construct(\DateTimeInterface $date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->date->format("Y-m-d H:i:s");
    }
}
