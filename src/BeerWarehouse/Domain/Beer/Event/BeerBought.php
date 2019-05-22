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
    /**
     * @param BeerId $beerId
     * @param Brewer $brewer
     * @param BeerName $name
     * @param BeerStyle $style
     * @return BeerBought
     */
    public static function withData(
        BeerId $beerId,
        Brewer $brewer,
        BeerName $name,
        BeerStyle $style
    ): BeerBought {
        $event = self::occur(
            $beerId->toString(),
            [
                'brewer' => $brewer->toString(),
                'name' => $name->toString(),
                'style' => $style->toString()
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
     * @return Brewer
     */
    public function brewer(): Brewer
    {
        return Brewer::fromString($this->payload['brewer']);
    }

    /**
     * @return BeerName
     */
    public function name(): BeerName
    {
        return BeerName::fromString($this->payload['name']);
    }

    /**
     * @return BeerStyle
     */
    public function style(): BeerStyle
    {
        return BeerStyle::fromString($this->payload['style']);
    }

    /**
     * @return BoughtDate
     */
    public function date(): BoughtDate
    {
        return BoughtDate::fromDateTime($this->createdAt());
    }
}
