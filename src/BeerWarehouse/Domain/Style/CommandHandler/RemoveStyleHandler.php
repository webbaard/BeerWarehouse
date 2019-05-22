<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Style\CommandHandler;

use Webbaard\BeerWarehouse\Domain\Location\Repository\Locations;
use Webbaard\BeerWarehouse\Domain\Location\Command\RemoveLocation;
use Webbaard\BeerWarehouse\Domain\Style\Command\RemoveStyle;
use Webbaard\BeerWarehouse\Domain\Style\Repository\Styles;

final class RemoveStyleHandler
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
     * @param RemoveStyle $command
     */
    public function __invoke(RemoveStyle $command): void
    {
        $style = $this->styles->getStyle($command->styleId());
        $style->remove();
        $this->styles->save($style);
    }
}
