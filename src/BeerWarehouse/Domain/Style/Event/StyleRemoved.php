<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Style\Event;

use Prooph\EventSourcing\AggregateChanged;
use Webbaard\BeerWarehouse\Domain\Style\ValueObject\RemovedDate;
use Webbaard\BeerWarehouse\Domain\Style\ValueObject\StyleId;

final class StyleRemoved  extends AggregateChanged
{
    /**
     * @param StyleId $styleId
     * @return StyleRemoved
     */
    public static function now(
        StyleId $styleId
    ): StyleRemoved
    {
        $event = self::occur(
            $styleId->toString(),
            []
        );

        return $event;
    }

    /**
     * @return StyleId
     */
    public function id(): StyleId
    {
        return StyleId::fromString($this->aggregateId());
    }

    /**
     * @return RemovedDate
     */
    public function removed(): RemovedDate
    {
        return RemovedDate::fromDateTime($this->createdAt());
    }
}