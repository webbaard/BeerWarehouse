<?php
declare(strict_types=1);

namespace Webbaard\Immutability\ValueObjects;

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


    public function createMutableBeer(): Beer
    {
        $beer = New MutableBeer(
            'KBS',
            'Founders',
            'Russian Imperial Stout'
        );
        $beer->setName('Not KBS');

        return $beer;
    }
}
