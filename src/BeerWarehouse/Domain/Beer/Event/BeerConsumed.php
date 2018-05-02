<?php
declare(strict_types=1);

namespace BeerWarehouse\Domain\Beer\Event;

use BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use BeerWarehouse\Domain\Beer\ValueObject\BoughtDate;
use BeerWarehouse\Domain\Beer\ValueObject\ConsumeDate;
use BeerWarehouse\Domain\Beer\ValueObject\Location;
use Prooph\EventSourcing\AggregateChanged;

final class BeerConsumed extends AggregateChanged
{
    private $beerId;
    private $date;

    public static function now(BeerId $beerId): BeerConsumed
    {
        $event = self::occur(
            (string)$beerId,
            []
        );
        $event->date = ConsumeDate::fromDateTime($event->createdAt());
        $event->beerId = $beerId;

        return $event;
    }

    public function id(): BeerId
    {
        if (null === $this->beerId) {
            $this->beerId = BeerId::fromString($this->aggregateId());
        }
        return $this->beerId;
    }

    public function date(): ConsumeDate
    {
        if (null === $this->beerId) {
            $this->date = ConsumeDate::fromDateTime($this->createdAt());
        }
        return $this->date;
    }
}
