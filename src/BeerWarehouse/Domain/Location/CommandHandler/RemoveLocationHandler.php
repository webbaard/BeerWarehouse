<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\CommandHandler;

use Webbaard\BeerWarehouse\Domain\Location\Repository\Locations;
use Webbaard\BeerWarehouse\Domain\Location\Command\RemoveLocation;

final class RemoveLocationHandler
{
    /** @var Locations  */
    private $locations;

    /**
     * ConsumeBeerHandler constructor.
     * @param Locations $beerCollection
     */
    public function __construct(Locations $beerCollection)
    {
        $this->locations = $beerCollection;
    }

    /**
     * @param RemoveLocation $command
     */
    public function __invoke(RemoveLocation $command): void
    {
        $location = $this->locations->getLocation($command->locationId());
        $location->remove();
        $this->locations->save($location);
    }
}
