<?php
declare(strict_types=1);

namespace Webbaard\Immutability\IsValid;

class BeerManager
{
    public function createBeer(): Beer
    {
        $beer = New Beer;
        $beer->setName('KBS');
        $beer->setBrewer('founders');
        $beer->setStyle('Russian Imperial Stout');
        return $beer;
    }
}
