<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Repository;

use Webbaard\BeerWarehouse\Domain\Beer\Repository\BeerCollection;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Webbaard\BeerWarehouse\Domain\Beer\Beer;

final class BeerRepository extends AggregateRepository implements BeerCollection
{
    /**
     * @param Beer $beer
     */
    public function save(Beer $beer): void
    {
        $this->saveAggregateRoot($beer);
    }

    /**
     * @param BeerId $beerId
     * @return Beer|object
     */
    public function getBeer(BeerId $beerId): Beer
    {
        return $this->getAggregateRoot($beerId->toString());
    }
















}













