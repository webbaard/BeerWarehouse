<?php

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Location;

use Doctrine\DBAL\DBALException;
use Prooph\EventStore\Projection\ProjectionManager as ProophProjectionManager;
use Prooph\EventStore\Projection\ReadModel;
use Prooph\EventStore\Projection\ReadModelProjector;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\ProjectionManager;

class LocationProjectionManager implements ProjectionManager
{
    const LOCATION_PROJECTION = 'location_projection';

    /** @var ReadModelProjector */
    private $locationProjector;

    /** @var LocationReadModel */
    private $locationReadModel;

    public function __construct(
        ProophProjectionManager $projectionManager,
        LocationProjection $locationProjection,
        LocationReadModel $locationReadModel
    ) {
        $this->locationReadModel = $locationReadModel;
        $this->locationProjector = $locationProjection->project(
            $projectionManager->createReadModelProjection(self::LOCATION_PROJECTION, $locationReadModel)
        );
    }

    /**
     * @return ReadModelProjector
     */
    public function get(): ReadModelProjector
    {
        return $this->locationProjector;
    }

    /**
     * @return bool
     * @throws DBALException
     */
    public function exists(): bool
    {
        return $this->locationReadModel->isInitialized();
    }
}
