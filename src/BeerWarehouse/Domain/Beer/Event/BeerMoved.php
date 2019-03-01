<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Event;

use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Location;
use Prooph\EventSourcing\AggregateChanged;




final class BeerMoved extends AggregateChanged
{
    public static function withData(BeerId $beerId, Location $location): BeerMoved
    {
        $event = self::occur(
            (string)$beerId,
            [
                'location' => (string)$location
            ]
        );
        return $event;
    }

    public function id(): BeerId
    {
        return BeerId::fromString($this->aggregateId());
    }

    public function location(): Location
    {
        return Location::fromString($this->payload['location']);
    }
}
