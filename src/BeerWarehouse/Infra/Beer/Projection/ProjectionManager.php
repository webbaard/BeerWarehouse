<?php

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection;

use Prooph\EventStore\Projection\ReadModelProjector;

interface ProjectionManager
{
    public function get(): ReadModelProjector;
}
