<?php
declare(strict_types=1);

namespace Webbaard\Immutability\ValueObjects;

class BeerManager
{
    public function createBeer(): Beer
    {
        $beer = New Beer(
            new Name('KBS'),
            new Brewer('Founders'),
            new Style('Russian Imperial Stout')
        );

        return $beer;
    }
}
