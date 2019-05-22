<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Event;

use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Location;
use Prooph\EventSourcing\AggregateChanged;

final class BeerMoved extends AggregateChanged
{
    /**
     * @param BeerId $beerId
     * @param Location $location
     * @return BeerMoved
     */
    public static function withData(BeerId $beerId, Location $location): BeerMoved
    {
        $event = self::occur(
            $beerId->toString(),
            [
                'location' => $location->toString()
            ]
        );
        return $event;
    }

    /**
     * @return BeerId
     */
    public function id(): BeerId
    {
        return BeerId::fromString($this->aggregateId());
    }

    /**
     * @return Location
     */
    public function location(): Location
    {
        return Location::fromString($this->payload['location']);
    }
}
