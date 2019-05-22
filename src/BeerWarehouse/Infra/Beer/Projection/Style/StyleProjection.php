<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Style;

use Prooph\Bundle\EventStore\Projection\ReadModelProjection;
use Prooph\EventStore\Projection\ReadModelProjector;
use Webbaard\BeerWarehouse\Domain\Style\Event\StyleAdded;
use Webbaard\BeerWarehouse\Domain\Style\Event\StyleRemoved;

final class StyleProjection implements ReadModelProjection
{
    public function project(ReadModelProjector $projector): ReadModelProjector
    {
        $projector->fromStream('event_stream')
            ->init(function (): array {
                return ['running' => true];
            })
            ->when([
                StyleAdded::class => function($state, StyleAdded $event) {
                    /** @var StyleReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('insert', [
                        'id' => $event->id()->toString(),
                        'name' => $event->name()->toString()
                    ]);
                },
                StyleRemoved::class => function($state, StyleRemoved $event) {
                    /** @var StyleReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('remove', [
                        'id' => $event->id()->toString(),
                    ]);
                }
            ]);
        return $projector;
    }
}
