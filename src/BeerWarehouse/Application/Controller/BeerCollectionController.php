<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Doctrine\DBAL\DBALException;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer\BeerFinder;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Class Beer Collection
 */
final class BeerCollectionController
{
    /**
     * @var EngineInterface
     */
    private $templateEngine;
    /**
     * @var BeerFinder
     */
    private $beerFinder;

    /**
     * BeerCollectionController constructor.
     * @param EngineInterface $templateEngine
     * @param BeerFinder $beerFinder
     */
    public function __construct(EngineInterface $templateEngine, BeerFinder $beerFinder)
    {
        $this->templateEngine = $templateEngine;
        $this->beerFinder = $beerFinder;
    }

    /**
     * @return Response
     * @throws DBALException
     */
    public function collectionAction(): Response
    {
        $beers = $this->beerFinder->findAll();
        return $this->templateEngine->renderResponse(
            'pages/beerCollection/beerCollection.html.twig',
            ['beers' => $beers]
        );
    }
}
