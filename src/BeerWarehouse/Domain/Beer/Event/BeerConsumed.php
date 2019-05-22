<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Event;

use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\ConsumeDate;
use Prooph\EventSourcing\AggregateChanged;

final class BeerConsumed extends AggregateChanged
{
    /**
     * @param BeerId $beerId
     * @return BeerConsumed
     */
    public static function now(BeerId $beerId): BeerConsumed
    {
        $event = self::occur(
            $beerId->toString(),
            []
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
     * @return ConsumeDate
     */
    public function date(): ConsumeDate
    {
        return ConsumeDate::fromDateTime($this->createdAt());
    }
}







