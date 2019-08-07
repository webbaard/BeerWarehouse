<?php
declare(strict_types=1);

namespace Tests\Webbaard\Immutability\GettersSetters;

use PHPUnit\Framework\TestCase;
use Webbaard\Immutability\GettersSetters\Beer;
use Webbaard\Immutability\GettersSetters\BeerManager;

class BeerManagerTest extends TestCase
{
    public function testBeerManager()
    {
        $beerManager = new BeerManager();

        $this->assertInstanceOf(
            Beer::class,
            $beerManager->createBeer()
        );

        $this->assertSame(
            'KBS',
            $beerManager->createBeer()->getName()
        );
    }
}
