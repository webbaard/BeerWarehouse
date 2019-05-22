<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Style\Repository;

use Webbaard\BeerWarehouse\Domain\Style\Style;
use Webbaard\BeerWarehouse\Domain\Style\ValueObject\StyleId;

interface Styles
{
    /**
     * @param Style $style
     * @return void
     */
    public function save(Style $style): void;

    /**
     * @param StyleId $styleId
     * @return Style
     */
    public function getStyle(StyleId $styleId): Style;
}
