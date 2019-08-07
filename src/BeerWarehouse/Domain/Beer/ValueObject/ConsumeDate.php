<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class ConsumeDate
{
    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * @param \DateTimeInterface $date
     * @return ConsumeDate
     */
    public static function fromDateTime(\DateTimeInterface $date): ConsumeDate
    {
        return new self($date);
    }

    /**
     * ConsumeDate constructor.
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
