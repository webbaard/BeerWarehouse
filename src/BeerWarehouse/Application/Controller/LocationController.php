<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @return Response
     */
    public function detailsAction($id): Response
    {
        $beers = $this->locationFinder->findById($id);
        return new JsonResponse($beers);
    }
}
