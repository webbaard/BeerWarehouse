<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Repository;

use Webbaard\BeerWarehouse\Domain\Beer\Beer;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;

interface BeerCollection
{
    /**
     * @param Beer $beer
     * @return void
     */
    public function save(Beer $beer): void;

    /**
     * @param BeerId $beerId
     * @return Beer
     */
    public function getBeer(BeerId $beerId): Beer;
}






