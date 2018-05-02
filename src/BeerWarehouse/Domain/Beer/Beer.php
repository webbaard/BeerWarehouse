<?php
declare(strict_types=1);

namespace BeerWarehouse\Domain\Beer;

use BeerWarehouse\Domain\Beer\Event\BeerBought;
use BeerWarehouse\Domain\Beer\Event\BeerMoved;
use BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use BeerWarehouse\Domain\Beer\ValueObject\BeerName;
use BeerWarehouse\Domain\Beer\ValueObject\BeerStyle;
use BeerWarehouse\Domain\Beer\ValueObject\Brewer;
use BeerWarehouse\Domain\Beer\ValueObject\Location;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Ramsey\Uuid\Uuid;

final class Beer extends AggregateRoot
{
    private $beerId;
    private $brewer;
    private $name;
    private $style;
    private $location;








    public static function buyBeer(
        Brewer $brewer,
        BeerName $name,
        BeerStyle $style
    ): Beer {
        $self = new self();
        $beerId = BeerId::fromString((string)Uuid::uuid4());
        $self->recordThat(BeerBought::withData($beerId, $brewer, $name, $style));
        return $self;
    }

    public function moveTo(Location $location): void
    {
        $this->recordThat(BeerMoved::withData($this->beerId, $location));
    }









    public function brewer(): Brewer
    {
        return $this->brewer;
    }
    public function name(): BeerName
    {
        return $this->name;
    }
    public function style(): BeerStyle
    {
        return $this->style;
    }

    protected function aggregateId(): string
    {
        return (string)$this->beerId;
    }










    protected function whenBeerWasBought(BeerBought $event): void
    {
        $this->brewer = $event->brewer();
        $this->name = $event->name();
        $this->style = $event->style();
    }

    protected function whenBeerWasMoved(BeerMoved $event): void
    {
        $this->location = $event->location();
    }

    protected function apply(AggregateChanged $event): void
    {
        switch(true) {
            case $event instanceof BeerBought:
                $this->whenBeerWasBought($event);
                break;
            case $event instanceof BeerMoved:
                $this->whenBeerWasMoved($event);
                break;
        }
    }








}
