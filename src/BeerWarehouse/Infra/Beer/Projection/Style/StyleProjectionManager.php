<?php

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Style;

use Doctrine\DBAL\DBALException;
use Prooph\EventStore\Projection\ProjectionManager as ProophProjectionManager;
use Prooph\EventStore\Projection\ReadModel;
use Prooph\EventStore\Projection\ReadModelProjector;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\ProjectionManager;

class StyleProjectionManager implements ProjectionManager
{
    const STYLE_PROJECTION = 'style_projection';

    /** @var ReadModelProjector */
    private $styleProjector;

    /** @var StyleReadModel */
    private $styleReadModel;

    /**
     * StyleProjectionManager constructor.
     * @param ProophProjectionManager $projectionManager
     * @param StyleProjection $styleProjection
     * @param ReadModel $styleReadModel
     */
    public function __construct(
        ProophProjectionManager $projectionManager,
        StyleProjection $styleProjection,
        ReadModel $styleReadModel
    ) {
        $this->styleReadModel = $styleReadModel;
        $this->styleProjector = $styleProjection->project(
            $projectionManager->createReadModelProjection(self::STYLE_PROJECTION, $styleReadModel)
        );
    }

    /**
     * @return ReadModelProjector
     */
    public function get(): ReadModelProjector
    {
        return $this->styleProjector;
    }

    /**
     * @return bool
     * @throws DBALException
     */
    public function exists(): bool
    {
        return $this->styleReadModel->isInitialized();
    }
}
