<?php
declare(strict_types=1);

namespace BeerWarehouse\Domain\Beer\Repository;

use BeerWarehouse\Domain\Beer\Beer;
use BeerWarehouse\Domain\Beer\ValueObject\BeerId;






interface BeerCollection
{
    public function save(Beer $beer);

    public function getBeer(BeerId $beerId): Beer;
}






