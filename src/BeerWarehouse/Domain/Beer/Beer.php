<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer;

use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerBought;
use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerConsumed;
use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerMoved;
use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerRemoved;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerName;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerStyle;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BoughtDate;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Brewer;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\ConsumeDate;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Location;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Ramsey\Uuid\Uuid;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\RemovedDate;

final class Beer extends AggregateRoot
{
    /** @var BeerId */
    private $beerId;

    /** @var Brewer */
    private $brewer;

    /** @var BeerName */
    private $name;

    /** @var BeerStyle */
    private $style;

    /** @var Location */
    private $location;

    /** @var BoughtDate */
    private $bought;

    /** @var ConsumeDate */
    private $consumed;

    /** @var RemovedDate */
    private $removed;

    /**
     * @param Brewer $brewer
     * @param BeerName $name
     * @param BeerStyle $style
     * @return Beer
     * @throws \Exception
     */
    public static function buyBeer(
        Brewer $brewer,
        BeerName $name,
        BeerStyle $style
    ): Beer {
        $self = new self();
        $self->beerId = BeerId::fromString(Uuid::uuid4()->toString());
        $self->recordThat(BeerBought::withData($self->beerId, $brewer, $name, $style));
        return $self;
    }

    /**
     * @param Location $location
     */
    public function moveTo(Location $location): void
    {
        $this->recordThat(BeerMoved::withData($this->beerId, $location));
    }

    public function consume(): void
    {
        $this->recordThat(BeerConsumed::now($this->beerId));
    }

    public function remove(): void
    {
        $this->recordThat(BeerRemoved::now($this->beerId));
    }

    /**
     * @return Brewer
     */
    public function brewer(): Brewer
    {
        return $this->brewer;
    }

    /**
     * @return BeerName
     */
    public function name(): BeerName
    {
        return $this->name;
    }

    /**
     * @return BeerStyle
     */
    public function style(): BeerStyle
    {
        return $this->style;
    }

    /**
     * @return BoughtDate
     */
    public function boughtOn(): BoughtDate
    {
        return $this->bought;
    }

    /**
     * @return ConsumeDate
     */
    public function consumedOn(): ConsumeDate
    {
        return $this->consumed;
    }

    /**
     * @return RemovedDate
     */
    public function removedOn(): RemovedDate
    {
        return $this->removed;
    }

    /**
     * @return string
     */
    protected function aggregateId(): string
    {
        return $this->beerId->toString();
    }

    /**
     * @param BeerBought $event
     */
    protected function whenBeerWasBought(BeerBought $event): void
    {
        $this->beerId = BeerId::fromString($event->aggregateId());
        $this->brewer = $event->brewer();
        $this->name = $event->name();
        $this->style = $event->style();
        $this->bought = $event->date();
    }

    /**
     * @param BeerMoved $event
     */
    protected function whenBeerWasMoved(BeerMoved $event): void
    {
        $this->location = $event->location();
    }

    /**
     * @param BeerConsumed $event
     */
    protected function whenBeerWasConsumed(BeerConsumed $event): void
    {
        $this->consumed = $event->date();
    }

    /**
     * @param BeerRemoved $event
     */
    protected function whenBeerWasRemoved(BeerRemoved $event): void
    {
        $this->removed = $event->removed();
    }

    /**
     * @param AggregateChanged $event
     */
    protected function apply(AggregateChanged $event): void
    {
        switch(true) {
            case $event instanceof BeerBought:
                $this->whenBeerWasBought($event);
                break;
            case $event instanceof BeerMoved:
                $this->whenBeerWasMoved($event);
                break;
            case $event instanceof BeerConsumed:
                $this->whenBeerWasConsumed($event);
                break;
            case $event instanceof BeerRemoved:
                $this->whenBeerWasRemoved($event);
                break;
        }
    }
}
