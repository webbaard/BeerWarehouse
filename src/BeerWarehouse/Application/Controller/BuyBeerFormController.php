<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer\BeerFinder;

final class BuyBeerController
{
    /**
     * @var EngineInterface
     */
    private $templateEngine;
    /**
     * @var BeerFinder
     */
    private $beerFinder;

    public function __construct(EngineInterface $templateEngine, BeerFinder $beerFinder)
    {
        $this->templateEngine = $templateEngine;
        $this->beerFinder = $beerFinder;
    }

    public function formAction(Request $request): Response
    {
        return $this->templateEngine->renderResponse(
            'default/buy-beer-form.html.twig'
        );
    }
}