<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Event;

use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerName;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerStyle;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BoughtDate;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Brewer;
use Prooph\EventSourcing\AggregateChanged;



final class BeerBought extends AggregateChanged
{
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

        return $event;
    }





    public function id(): BeerId
    {
        return BeerId::fromString($this->aggregateId());
    }

    public function brewer(): Brewer
    {
        return Brewer::fromString($this->payload['brewer']);
    }

    public function name(): BeerName
    {
        return BeerName::fromString($this->payload['name']);
    }

    public function style(): BeerStyle
    {
        return BeerStyle::fromString($this->payload['style']);
    }

    public function date(): BoughtDate
    {
        return BoughtDate::fromDateTime($this->createdAt());
    }





}
