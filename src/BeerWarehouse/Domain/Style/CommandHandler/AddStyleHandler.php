<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Style\CommandHandler;

use Webbaard\BeerWarehouse\Domain\Location\Repository\Locations;
use Webbaard\BeerWarehouse\Domain\Location\Command\AddLocation;
use Webbaard\BeerWarehouse\Domain\Location\Location;
use Webbaard\BeerWarehouse\Domain\Style\Command\AddStyle;
use Webbaard\BeerWarehouse\Domain\Style\Repository\Styles;
use Webbaard\BeerWarehouse\Domain\Style\Style;

final class AddStyleHandler
{
    /** @var Styles  */
    private $styles;

    /**
     * ConsumeBeerHandler constructor.
     * @param Styles $styles
     */
    public function __construct(Styles $styles)
    {
        $this->styles = $styles;
    }

    /**
     * @param AddStyle $command
     * @throws \Exception
     */
    public function __invoke(AddStyle $command): void
    {
        $style = Style::fromDescription(
            $command->name()
        );
        $this->styles->save($style);
    }
}
