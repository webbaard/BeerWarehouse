<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Repository;

use Webbaard\BeerWarehouse\Domain\Beer\Beer;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;

interface BeerCollection
{
    public function save(Beer $beer);

    public function getBeer(BeerId $beerId): Beer;
}






