<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\CommandHandler;

use Webbaard\BeerWarehouse\Domain\Beer\Command\MoveBeer;
use Webbaard\BeerWarehouse\Domain\Beer\Repository\BeerCollection;

final class MoveBeerHandler
{
    private $beerCollection;

    /**
     * MoveBeerHandler constructor.
     * @param BeerCollection $beerCollection
     */
    public function __construct(BeerCollection $beerCollection)
    {
        $this->beerCollection = $beerCollection;
    }

    /**
     * @param MoveBeer $command
     */
    public function __invoke(MoveBeer $command): void
    {
        $beer = $this->beerCollection->getBeer($command->beerId());
        $beer->moveTo($command->location());
        $this->beerCollection->save($beer);
    }
}
