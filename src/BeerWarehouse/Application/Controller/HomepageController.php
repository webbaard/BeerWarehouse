<?php

declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class HomepageController
 * @package Webbaard\BeerWarehouse\Application\Controller
 */
final class HomepageController
{
    private Environment $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    public function indexAction(Request $request): Response
    {
        return new Response(
            $this
            ->environment
            ->render(
                'pages/homepage/dashboard.html.twig'
            )
        );
    }
}
