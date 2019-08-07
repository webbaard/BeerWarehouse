<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\Event;

use Prooph\EventSourcing\AggregateChanged;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\LocationId;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\RemovedDate;

final class LocationRemoved  extends AggregateChanged
{
    /**
     * @param LocationId $locationId
     * @return LocationRemoved
     */
    public static function now(
        LocationId $locationId
    ): LocationRemoved
    {
        $event = self::occur(
            $locationId->toString(),
            []
        );

        return $event;
    }

    /**
     * @return LocationId
     */
    public function id(): LocationId
    {
        return LocationId::fromString($this->aggregateId());
    }

    /**
     * @return RemovedDate
     */
    public function removed(): RemovedDate
    {
        return RemovedDate::fromDateTime($this->createdAt());
    }
}