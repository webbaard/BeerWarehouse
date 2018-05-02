<?php
declare(strict_types=1);

namespace BeerWarehouse\Domain\Beer\Event;

use BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use BeerWarehouse\Domain\Beer\ValueObject\BeerName;
use BeerWarehouse\Domain\Beer\ValueObject\BeerStyle;
use BeerWarehouse\Domain\Beer\ValueObject\Brewer;
use Prooph\EventSourcing\AggregateChanged;

final class BeerBought extends AggregateChanged
{
    private $beerId;
    private $brewer;
    private $name;
    private $style;





    public static function withData(
        BeerId $beerId,
        Brewer $brewer,
        BeerName $name,
        BeerStyle $style
    ): BeerBought {
        $event = self::occur(
            (string)$beerId,
            [
                'brewer' => (string)$brewer,
                'name' => (string)$name,
                'style' => (string)$style
            ]
        );

        $event->beerId = $beerId;
        $event->brewer = $brewer;
        $event->name = $name;
        $event->style = $style;

        return $event;
    }







    public function id(): BeerId
    {
        if (null === $this->beerId) {
            $this->beerId = BeerId::fromString($this->aggregateId());
        }
        return $this->beerId;
    }

    public function brewer(): Brewer
    {
        if (null === $this->brewer) {
            $this->brewer = Brewer::fromString($this->payload['brewer']);
        }
        return $this->brewer;
    }

    public function name(): BeerName
    {
        if (null === $this->name) {
            $this->name = BeerName::fromString($this->payload['name']);
        }
        return $this->name;
    }

    public function style(): BeerStyle
    {
        if (null === $this->style) {
            $this->style = BeerStyle::fromString($this->payload['style']);
        }
        return $this->style();
    }
}
