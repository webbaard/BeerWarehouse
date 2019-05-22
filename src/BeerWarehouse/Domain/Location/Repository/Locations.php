<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\Repository;

use Webbaard\BeerWarehouse\Domain\Location\Location;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\LocationId;

interface Locations
{
    /**
     * @param Location $style
     * @return void
     */
    public function save(Location $style): void;

    /**
     * @param LocationId $styleId
     * @return Location
     */
    public function getLocation(LocationId $styleId): Location;
}
