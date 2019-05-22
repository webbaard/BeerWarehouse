<?php
declare(strict_types=1);

namespace Webbaard\Immutability\Reflection;

use ReflectionClass;

class BeerManager
{
    /**
     * @return Beer
     * @throws \ReflectionException
     */
    public function createBeer(): Beer
    {
        $beer = New Beer(
            'KBS',
            'Founders',
            'Russian Imperial Stout'
        );

        $mutableBeer = new ReflectionClass('Beer');
        $beerName = $mutableBeer->getProperty('name');
        $beerName->setAccessible(true);
        $beerName->setValue($mutableBeer, 'not KBS');

        return $beer;
    }
}
