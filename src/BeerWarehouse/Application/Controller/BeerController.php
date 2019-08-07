<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer\BeerFinder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BeerController
 * @package Webbaard\BeerWarehouse\Application\Controller
 */
final class BeerController
{
    /** @var BeerFinder */
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
    public function detailsAction($id): Response
    {
        $beers = $this->beerFinder->findById($id);
        return new JsonResponse($beers);
    }
}
