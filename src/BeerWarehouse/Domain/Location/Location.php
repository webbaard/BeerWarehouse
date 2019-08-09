<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location;

use Exception;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Ramsey\Uuid\Uuid;
use Webbaard\BeerWarehouse\Domain\Location\Event\LocationAdded;
use Webbaard\BeerWarehouse\Domain\Location\Event\LocationRemoved;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\Container;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\LocationId;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\RemovedDate;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\Room;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\Shelf;

final class Location extends AggregateRoot{

    /** @var LocationId */
    private $locationId;

    /** @var Room */
    private $room;

    /** @var Container */
    private $container;

    /** @var Shelf */
    private $shelf;

    /** @var RemovedDate */
    private $removed;

    /**
     * @param Room $room
     * @param Container $container
     * @param Shelf $shelf
     * @return Location
     * @throws Exception
     */
    public static function fromDescription(
        Room $room,
        Container $container,
        Shelf $shelf
    ): Location {
        $self = new self();
        $self->locationId = LocationId::fromString(Uuid::uuid4()->toString());
        $self->recordThat(LocationAdded::withData($self->locationId, $room, $container, $shelf));
        return $self;
    }

    public function remove(): void
    {
        $this->recordThat(LocationRemoved::now($this->locationId));
    }
    /**
     * @return string
     */
    protected function aggregateId(): string
    {
        return $this->locationId->toString();
    }

    /**
    * @param LocationAdded $event
    */
    protected function whenLocationWasAdded(LocationAdded $event): void
    {
        $this->locationId = LocationId::fromString($event->aggregateId());
        $this->room = $event->room();
        $this->container = $event->container();
        $this->shelf = $event->shelf();
    }

    /**
     * @param LocationRemoved $event
     */
    protected function whenLocationWasRemoved(LocationRemoved $event): void
    {
        $this->removed = $event->removed();
    }

    /**
     * @param AggregateChanged $event
     */
    protected function apply(AggregateChanged $event): void
    {
        switch(true) {
            case $event instanceof LocationAdded:
                $this->whenLocationWasAdded($event);
                break;
            case $event instanceof LocationRemoved:
                $this->whenLocationWasRemoved($event);
                break;
        }
    }
}
