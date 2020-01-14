<?php

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer;

use Doctrine\DBAL\DBALException;
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

    public function __construct(
        ProophProjectionManager $projectionManager,
        BeerProjection $beerProjection,
        BeerReadModel $beerReadModel
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
     * @throws DBALException
     */
    public function exists(): bool
    {
        return $this->beerReadModel->isInitialized();
    }
}
