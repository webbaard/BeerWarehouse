<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\CommandHandler;

use Webbaard\BeerWarehouse\Domain\Location\Repository\Locations;
use Webbaard\BeerWarehouse\Domain\Location\Command\AddLocation;
use Webbaard\BeerWarehouse\Domain\Location\Location;

final class AddLocationHandler
{
    /** @var Locations  */
    private $locations;

    /**
     * ConsumeBeerHandler constructor.
     * @param Locations $locations
     */
    public function __construct(Locations $locations)
    {
        $this->locations = $locations;
    }

    /**
     * @param AddLocation $command
     * @throws \Exception
     */
    public function __invoke(AddLocation $command): void
    {
        $location = Location::fromDescription(
            $command->room(),
            $command->container(),
            $command->shelf()
        );
        $this->locations->save($location);
    }
}
