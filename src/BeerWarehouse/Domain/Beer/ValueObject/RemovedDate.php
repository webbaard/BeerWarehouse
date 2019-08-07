<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class RemovedDate
{
    /** @var \DateTimeInterface  */
    private $date;

    /**
     * @param \DateTimeInterface $date
     * @return RemovedDate
     */
    public static function fromDateTime(\DateTimeInterface $date): RemovedDate
    {
        return new self($date);
    }

    /**
     * RemovedDate constructor.
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
        return $this->date->format("c");
    }
}
