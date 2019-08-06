<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Style\StyleFinder;

/**
 * Class StyleController
 * @package Webbaard\BeerWarehouse\Application\Controller
 */
final class StyleController
{
    /** @var StyleFinder */
    private $styleFinder;

    /**
     * StyleController constructor.
     * @param StyleFinder $styleFinder
     */
    public function __construct(StyleFinder $styleFinder)
    {
        $this->styleFinder = $styleFinder;
    }

    /**
     * @return Response
     */
    public function detailsAction($id): Response
    {
        $beers = $this->styleFinder->findById($id);
        return new JsonResponse($beers);
    }
}
