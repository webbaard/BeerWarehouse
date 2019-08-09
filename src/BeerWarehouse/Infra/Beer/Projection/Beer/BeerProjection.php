<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer;

use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerBought;
use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerConsumed;
use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerMoved;
use Prooph\Bundle\EventStore\Projection\ReadModelProjection;
use Prooph\EventStore\Projection\ReadModelProjector;
use Webbaard\BeerWarehouse\Domain\Beer\Event\BeerRemoved;
use Webbaard\BeerWarehouse\Domain\Location\Event\LocationAdded;
use Webbaard\BeerWarehouse\Domain\Location\Event\LocationRemoved;
use Webbaard\BeerWarehouse\Domain\Style\Event\StyleAdded;
use Webbaard\BeerWarehouse\Domain\Style\Event\StyleRemoved;

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
                return ['locations' => [], 'styles' => []];
            })
            ->when([
                BeerBought::class => function ($state, BeerBought $event) {
                    /** @var BeerReadModel $readModel */
                    $readModel = $this->readModel();
                    $style = isset($state['styles'][$event->style()->toString()]) ? $state['styles'][$event->style()->toString()] : $event->style()->toString();
                    $readModel->stack('insert', [
                        'id' => $event->id()->toString(),
                        'brewer' => $event->brewer()->toString(),
                        'name' => $event->name()->toString(),
                        'shop' => $event->shop() ? $event->shop()->toString() : null,
                        'style' => $style,
                        'bought_on' => $event->date()->toString()
                    ]);
                },
                BeerMoved::class => function ($state, BeerMoved $event) {
                    /** @var BeerReadModel $readModel */
                    $readModel = $this->readModel();
                    $location = isset($state['locations'][$event->location()->toString()]) ? $state['locations'][$event->location()->toString()] : $event->location()->toString();
                    $readModel->stack('update', [
                        'id' => $event->id()->toString(),
                        'location' => $location
                    ]);
                    return $state;
                },
                BeerConsumed::class => function ($state, BeerConsumed $event) {
                    /** @var BeerReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('remove', [
                        'id' => $event->id()->toString(),
                    ]);
                },
                BeerRemoved::class => function ($state, BeerRemoved $event) {
                    /** @var BeerReadModel $readModel */
                    $readModel = $this->readModel();
                    $readModel->stack('remove', [
                        'id' => $event->id()->toString(),
                    ]);
                },
                LocationAdded::class => function ($state, LocationAdded $event) {
                    $state['locations'][$event->id()->toString()] =
                        $event->room()->toString() . "-" .
                        $event->shelf()->toString() . "-" .
                        $event->container()->toString();
                    return $state;
                },
                LocationRemoved::class => function ($state, LocationRemoved $event) {
                    unset($state['locations'][$event->id()->toString()]);
                    return $state;
                },
                StyleAdded::class => function($state, StyleAdded $event) {
                    $state['styles'][$event->id()->toString()] =
                        $event->name()->toString();
                    return $state;
                },
                StyleRemoved::class => function($state, StyleRemoved $event) {
                    unset($state['styles'][$event->id()->toString()]);
                    return $state;
                }
            ]);

        return $projector;
    }
}
