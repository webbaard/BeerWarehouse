<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Event;

use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use Prooph\EventSourcing\AggregateChanged;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\RemovedDate;

final class BeerRemoved extends AggregateChanged
{
    /**
     * @param BeerId $beerId
     * @return BeerRemoved
     */
    public static function now(BeerId $beerId): BeerRemoved
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
     * @return RemovedDate
     */
    public function removed(): RemovedDate
    {
        return RemovedDate::fromDateTime($this->createdAt());
    }
}







