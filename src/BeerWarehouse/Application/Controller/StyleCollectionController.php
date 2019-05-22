<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Location\LocationFinder;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Style\StyleFinder;

/**
 * Class Beer Collection
 */
final class StyleCollectionController
{
    /**
     * @var StyleFinder
     */
    private $styleFinder;

    /**
     * StyleCollectionController constructor.
     * @param StyleFinder $styleFinder
     */
    public function __construct(StyleFinder $styleFinder)
    {
        $this->styleFinder = $styleFinder;
    }

    /**
     * @return Response
     */
    public function collectionAction(): Response
    {
        $beers = $this->styleFinder->findAll();
        return new JsonResponse($beers);
    }
}
