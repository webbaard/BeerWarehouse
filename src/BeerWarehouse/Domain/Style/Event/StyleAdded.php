<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Style\Event;

use Prooph\EventSourcing\AggregateChanged;
use Webbaard\BeerWarehouse\Domain\Style\ValueObject\Name;
use Webbaard\BeerWarehouse\Domain\Style\ValueObject\StyleId;

final class StyleAdded extends AggregateChanged
{
    /**
     * @param StyleId $styleId
     * @param Name $name
     * @return StyleAdded
     */
    public static function withData(
        StyleId $styleId,
        Name $name
    ): StyleAdded {
        $event = self::occur(
            $styleId->toString(),
            [
                'name' => $name->toString()
            ]
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
     * @return Name
     */
    public function name(): Name
    {
        return Name::fromString($this->payload['name']);
    }
}
