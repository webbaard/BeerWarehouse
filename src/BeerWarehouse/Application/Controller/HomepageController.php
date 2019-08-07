<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomepageController
 * @package Webbaard\BeerWarehouse\Application\Controller
 */
final class HomepageController
{
    /**
     * @var EngineInterface
     */
    private $templateEngine;

    /**
     * HomepageController constructor.
     * @param EngineInterface $engine
     */
    public function __construct(EngineInterface $engine)
    {
        $this->templateEngine = $engine;
    }

    public function indexAction(Request $request): Response
    {
        return $this
            ->templateEngine
            ->renderResponse(
                'pages/homepage/dashboard.html.twig'
            );
    }
}
