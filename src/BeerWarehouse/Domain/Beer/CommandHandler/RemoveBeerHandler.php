<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\CommandHandler;

use Webbaard\BeerWarehouse\Domain\Beer\Command\ConsumeBeer;
use Webbaard\BeerWarehouse\Domain\Beer\Command\RemoveBeer;
use Webbaard\BeerWarehouse\Domain\Beer\Repository\BeerCollection;

final class RemoveBeerHandler
{
    private $beerCollection;

    public function __construct(BeerCollection $beerCollection)
    {
        $this->beerCollection = $beerCollection;
    }

    public function __invoke(RemoveBeer $command): void
    {
        $beer = $this->beerCollection->getBeer($command->beerId());
        $beer->remove();
        $this->beerCollection->save($beer);
    }
}
