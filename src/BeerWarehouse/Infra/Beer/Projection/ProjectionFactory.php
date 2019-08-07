<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection;

use Prooph\EventStore\Projection\ReadModelProjector;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer\BeerProjectionManager;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Location\LocationProjectionManager;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Style\StyleProjectionManager;

/**
 * Class ProjectionFactory
 * @package Webbaard\BeerWarehouse\Infra\Beer\Projection
 */
class ProjectionFactory
{
    /** @var BeerProjectionManager */
    private $beerProjectionManager;

    /**
     * @var LocationProjectionManager
     */
    private $locationProjectionManager;

    /**
     * @var StyleProjectionManager
     */
    private $styleProjectionManager;

    /**
     * ProjectionFactory constructor.
     * @param BeerProjectionManager $beerProjectionManager
     * @param LocationProjectionManager $locationProjectionManager
     * @param StyleProjectionManager $styleProjectionManager
     */
    public function __construct(
        BeerProjectionManager $beerProjectionManager,
        LocationProjectionManager $locationProjectionManager,
        StyleProjectionManager $styleProjectionManager
    ) {
        $this->beerProjectionManager = $beerProjectionManager;
        $this->locationProjectionManager = $locationProjectionManager;
        $this->styleProjectionManager = $styleProjectionManager;
    }

    /**
     * Resets all the projections.
     */
    public function resetAll()
    {
        if ($this->beerProjectionManager->exists()) {
            $this->beer()->reset();
        }

        if ($this->locationProjectionManager->exists()) {
            $this->location()->reset();
        }

        if ($this->styleProjectionManager->exists()) {
            $this->style()->reset();
        }

        $this->beer()->run(false);
        $this->location()->run(false);
        $this->style()->run(false);
    }

    /**
     * @return ReadModelProjector
     */
    private function beer(): ReadModelProjector
    {
        return $this->beerProjectionManager->get();
    }

    /**
     * @return ReadModelProjector
     */
    private function location(): ReadModelProjector
    {
        return $this->locationProjectionManager->get();
    }

    /**
     * @return ReadModelProjector
     */
    private function style(): ReadModelProjector
    {
        return $this->styleProjectionManager->get();
    }
}
