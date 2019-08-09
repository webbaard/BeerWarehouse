<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Location;

use Prooph\Bundle\EventStore\Projection\ReadModelProjection;
use Prooph\EventStore\Projection\ReadModelProjector;
use Webbaard\BeerWarehouse\Domain\Location\Event\LocationAdded;
use Webbaard\BeerWarehouse\Domain\Location\Event\LocationRemoved;

final class LocationProjection implements ReadModelProjection
{
    public function project(ReadModelProjector $projector): ReadModelProjector
    {
        $projector->fromStream('event_stream')
            ->init(function (): array {
                return ['running' => true];
            })
            ->when([
                LocationAdded::class => function($state, LocationAdded $event) {
                    /** @var LocationReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('insert', [
                        'id' => $event->id()->toString(),
                        'room' => $event->room()->toString(),
                        'shelf' => $event->shelf()->toString(),
                        'container' => $event->container()->toString(),
                    ]);
                },
                LocationRemoved::class => function($state, LocationRemoved $event) {
                    /** @var LocationReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('remove', [
                        'id' => $event->id()->toString(),
                    ]);
                }
            ]);

        return $projector;
    }
}
