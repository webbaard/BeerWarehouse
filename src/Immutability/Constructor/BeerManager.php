<?php
declare(strict_types=1);

namespace Webbaard\Immutability\Constructor;

class BeerManager
{
    public function createBeer(): Beer
    {
        $beer = New Beer(
            'KBS',
            'Founders',
            'Russian Imperial Stout'
        );

        return $beer;
    }
}
