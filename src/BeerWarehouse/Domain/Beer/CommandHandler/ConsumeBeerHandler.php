<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\CommandHandler;

use Webbaard\BeerWarehouse\Domain\Beer\Beer;
use Webbaard\BeerWarehouse\Domain\Beer\Command\BuyBeer;
use Webbaard\BeerWarehouse\Domain\Beer\Command\ConsumeBeer;
use Webbaard\BeerWarehouse\Domain\Beer\Repository\BeerCollection;

final class ConsumeBeerHandler
{
    private $beerCollection;

    public function __construct(BeerCollection $beerCollection)
    {
        $this->beerCollection = $beerCollection;
    }

    public function __invoke(ConsumeBeer $command): void
    {
        $beer = $this->beerCollection->getBeer($command->beerId());
        $beer->consume();
        $this->beerCollection->save($beer);
    }
}
