<?php
declare(strict_types=1);

namespace BeerWarehouse\Domain\Beer\CommandHandler;

use BeerWarehouse\Domain\Beer\Beer;
use BeerWarehouse\Domain\Beer\Command\BuyBeer;
use BeerWarehouse\Domain\Beer\Repository\BeerCollection;

final class BuyBeerHandler
{
    private $beerCollection;

    public function __construct(BeerCollection $beerCollection)
    {
        $this->beerCollection = $beerCollection;
    }

    public function __invoke(BuyBeer $command): void
    {
        $beer = Beer::buyBeer(
            $command->brewer(),
            $command->name(),
            $command->style()
        );
        $beer->moveTo($command->location());
        $this->beerCollection->save($beer);
    }
}
