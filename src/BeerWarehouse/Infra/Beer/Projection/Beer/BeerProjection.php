<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer;

use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerBought;
use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerConsumed;
use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerMoved;
use Prooph\Bundle\EventStore\Projection\ReadModelProjection;
use Prooph\EventStore\Projection\ReadModelProjector;
use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerRemoved;

final class BeerProjection implements ReadModelProjection
{
    /**
     * @param ReadModelProjector $projector
     * @return ReadModelProjector
     */
    public function project(ReadModelProjector $projector): ReadModelProjector
    {
        $projector->fromStream('event_stream')
            ->init(function (): array {
                return ['running' => true];
            })
            ->when([
                BeerBought::class => function($state, BeerBought $event) {
                    /** @var BeerReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('insert', [
                        'id' => $event->id()->toString(),
                        'brewer' => $event->brewer()->toString(),
                        'name' => $event->name()->toString(),
                        'style' => $event->style()->toString(),
                        'bought_on' => $event->date()->toString()
                    ]);
                },
                BeerMoved::class => function($state, BeerMoved $event) {
                    /** @var BeerReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('update', [
                        'id' => $event->id()->toString(),
                        'location' => $event->location()->toString()
                    ]);
                },
                BeerConsumed::class => function($state, BeerConsumed $event) {
                    /** @var BeerReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('remove', [
                        'id' => $event->id()->toString(),
                    ]);
                },
                BeerRemoved::class => function($state, BeerRemoved $event) {
                    /** @var BeerReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('remove', [
                        'id' => $event->id()->toString(),
                    ]);
                }
            ]);

        return $projector;
    }
}
