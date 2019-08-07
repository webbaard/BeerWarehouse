<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Repository;

use Webbaard\BeerWarehouse\Domain\Location\Repository\Locations;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Webbaard\BeerWarehouse\Domain\Location\Location;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\LocationId;

final class LocationRepository extends AggregateRepository implements Locations
{
    /**
     * @param Location $style
     */
    public function save(Location $style): void
    {
        $this->saveAggregateRoot($style);
    }

    /**
     * @param LocationId $styleId
     * @return Location|object
     */
    public function getLocation(LocationId $styleId): Location
    {
        return $this->getAggregateRoot($styleId->toString());
    }
















}













