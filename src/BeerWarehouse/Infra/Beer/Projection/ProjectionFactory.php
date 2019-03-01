<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection;

use Prooph\EventStore\Projection\ReadModelProjector;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer\BeerProjectionManager;

class ProjectionFactory
{
    /** @var BeerProjectionManager*/
    private $beerProjectionManager;

    /**
     * ProjectionFactory constructor.
     * @param BeerProjectionManager $beerProjection
     */
    public function __construct(
        BeerProjectionManager $beerProjection
    ) {
        $this->beerProjectionManager = $beerProjection;
    }

    /**
     * @return ReadModelProjector
     */
    public function product(): ReadModelProjector
    {
        return $this->beerProjectionManager->get();
    }

    /**
     * Resets all the projections.
     */
    public function resetAll()
    {
        if ($this->beerProjectionManager->exists()) {
            $this->product()->reset();
        }
        $this->product()->run(false);
    }
}
