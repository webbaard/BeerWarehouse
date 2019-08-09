<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Webbaard\BeerWarehouse\Infra\Beer\Projection\Location\LocationFinder;

final class LocationController
{
    /** @var LocationFinder */
    private $locationFinder;

    /**
     * LocationController constructor.
     * @param LocationFinder $locationFinder
     */
    public function __construct(LocationFinder $locationFinder)
    {
        $this->locationFinder = $locationFinder;
    }
}
