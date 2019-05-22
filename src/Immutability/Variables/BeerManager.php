<?php
declare(strict_types=1);

namespace Webbaard\Immutability\Variables;

class BeerManager
{
    public function createBeer(): Beer
    {
        $beer = New Beer;
        $beer->name = 'KBS';
        $beer->brewer = 'founders';
        $beer->style = 'Russian Imperial Stout';
        return $beer;
    }
}
