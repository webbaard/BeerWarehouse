<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Event;

use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BoughtDate;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\ConsumeDate;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Location;
use Prooph\EventSourcing\AggregateChanged;




final class BeerConsumed extends AggregateChanged
{
    public static function now(BeerId $beerId): BeerConsumed
    {
        $event = self::occur(
            (string)$beerId,
            []
        );
        return $event;
    }

    public function id(): BeerId
    {
        return BeerId::fromString($this->aggregateId());
    }

    public function date(): ConsumeDate
    {
        return ConsumeDate::fromDateTime($this->createdAt());
    }
}







