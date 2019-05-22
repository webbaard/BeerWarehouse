<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Location\LocationFinder;

/**
 * Class Beer Collection
 */
final class LocationCollectionController
{
    /**
     * @var LocationFinder
     */
    private $locationFinder;

    /**
     * LocationCollectionController constructor.
     * @param LocationFinder $locationFinder
     */
    public function __construct(LocationFinder $locationFinder)
    {
        $this->locationFinder = $locationFinder;
    }

    /**
     * @return Response
     */
    public function collectionAction(): Response
    {
        $beers = $this->locationFinder->findAll();
        return new JsonResponse($beers);
    }
}
