<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer\BeerFinder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BeerCollectionController
 * @package Webbaard\BeerWarehouse\Application\Controller
 */
final class BeerCollectionController
{
    /**
     * @var BeerFinder
     */
    private $beerFinder;

    /**
     * BeerCollectionController constructor.
     * @param BeerFinder $beerFinder
     */
    public function __construct(BeerFinder $beerFinder)
    {
        $this->beerFinder = $beerFinder;
    }

    /**
     * @return Response
     */
    public function collectionAction(): Response
    {
        $beers = $this->beerFinder->findAll();
        return new JsonResponse($beers);
    }
}
