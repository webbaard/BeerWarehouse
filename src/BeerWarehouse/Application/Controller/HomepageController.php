<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class HomepageController
{
    /**
     * @var EngineInterface
     */
    private $templateEngine;
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
