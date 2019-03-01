<?php

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer;

use Prooph\EventStore\Projection\ProjectionManager as ProophProjectionManager;
use Prooph\EventStore\Projection\ReadModel;
use Prooph\EventStore\Projection\ReadModelProjector;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\ProjectionManager;

class BeerProjectionManager implements ProjectionManager
{
    const BEER_PROJECTION = 'beer_projection';

    /** @var ReadModelProjector */
    private $beerProjector;

    /** @var BeerReadModel */
    private $beerReadModel;

    /**
     * ProductProjectionManager constructor.
     * @param ProophProjectionManager $projectionManager
     * @param BeerProjection $beerProjection
     * @param ReadModel $beerReadModel
     */
    public function __construct(
        ProophProjectionManager $projectionManager,
        BeerProjection $beerProjection,
        ReadModel $beerReadModel
    ) {
        $this->beerReadModel = $beerReadModel;
        $this->beerProjector = $beerProjection->project(
            $projectionManager->createReadModelProjection(self::BEER_PROJECTION, $beerReadModel)
        );
    }

    /**
     * @return ReadModelProjector
     */
    public function get(): ReadModelProjector
    {
        return $this->beerProjector;
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        return $this->beerReadModel->isInitialized();
    }
}
