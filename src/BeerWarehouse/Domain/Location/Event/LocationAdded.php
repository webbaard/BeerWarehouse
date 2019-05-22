<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\Event;

use Prooph\EventSourcing\AggregateChanged;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\Container;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\LocationId;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\Room;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\Shelf;

final class LocationAdded extends AggregateChanged
{
    /**
     * @param LocationId $locationId
     * @param Room $room
     * @param Container $container
     * @param Shelf $shelf
     * @return LocationAdded
     */
    public static function withData(
        LocationId $locationId,
        Room $room,
        Container $container,
        Shelf $shelf
    ): LocationAdded {
        $event = self::occur(
            $locationId->toString(),
            [
                'room' => $room->toString(),
                'container' => $container->toString(),
                'shelf' => $shelf->toString()
            ]
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
     * @return Room
     */
    public function room(): Room
    {
        return Room::fromString($this->payload['room']);
    }

    /**
     * @return Container
     */
    public function container(): Container
    {
        return Container::fromString($this->payload['container']);
    }

    /**
     * @return Shelf
     */
    public function shelf(): Shelf
    {
        return Shelf::fromString($this->payload['shelf']);
    }
}
