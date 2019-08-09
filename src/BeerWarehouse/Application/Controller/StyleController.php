<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Application\Controller;

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
}
