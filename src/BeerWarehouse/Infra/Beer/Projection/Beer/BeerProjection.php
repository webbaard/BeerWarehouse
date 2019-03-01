<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer;

use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerBought;
use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerConsumed;
use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerMoved;
use Prooph\Bundle\EventStore\Projection\ReadModelProjection;
use Prooph\EventStore\Projection\ReadModelProjector;

final class BeerProjection implements ReadModelProjection
{
    public function project(ReadModelProjector $projector): ReadModelProjector
    {
        $projector->fromStream('event_steam')
            ->init(function (): array {
                return [];
            })
            ->when([
                BeerBought::class => function($state, BeerBought $event) {
                    /** @var BeerReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('insert', [
                        'id' => (string)$event->id(),
                        'brewer' => (string)$event->brewer(),
                        'name' => (string)$event->name(),
                        'style' => (string)$event->style(),
                        'bought_on' => (string)$event->date()
                    ]);
                },
                BeerMoved::class => function($state, BeerMoved $event) {
                    /** @var BeerReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('update', [
                        'id' => (string)$event->id(),
                        'location' => (string)$event->location()
                    ]);
                },
                BeerConsumed::class => function($state, BeerConsumed $event) {
                    /** @var BeerReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('delete', [
                        'id' => (string)$event->id(),
                    ]);
                }
            ]);
        return $projector;
    }
}
