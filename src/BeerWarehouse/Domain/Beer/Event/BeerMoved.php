<?php
declare(strict_types=1);

namespace BeerWarehouse\Domain\Beer\Event;

use BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use BeerWarehouse\Domain\Beer\ValueObject\Location;
use Prooph\EventSourcing\AggregateChanged;

final class BeerMoved extends AggregateChanged
{
    private $beerId;
    private $location;




    public static function withData(BeerId $beerId, Location $location): BeerMoved
    {
        $event = self::occur(
            (string)$beerId,
            [
                'location' => (string)$location
            ]
        );

        $event->beerId = $beerId;
        $event->location = $location;

        return $event;
    }





    public function id(): BeerId
    {
        if (null === $this->beerId) {
            $this->beerId = BeerId::fromString($this->aggregateId());
        }
        return $this->beerId;
    }

    public function location(): Location
    {
        if (null === $this->location) {
            $this->location = Location::fromString($this->payload['location']);
        }
        return $this->location;
    }







}
