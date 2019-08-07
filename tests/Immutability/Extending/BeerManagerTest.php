<?php
declare(strict_types=1);

namespace Tests\Webbaard\Immutability\FinalClass;

use PHPUnit\Framework\TestCase;
use Webbaard\Immutability\FinalClass\Beer;
use Webbaard\Immutability\FinalClass\BeerManager;

class BeerManagerTest extends TestCase
{
    public function testBeerManager()
    {
        $beerManager = new BeerManager();

        $this->assertInstanceOf(Beer::class, $beerManager->createBeer());
        $this->assertSame('KBS', $beerManager->createBeer()->getName());
    }

    public function testBeerManagerMutableBeer()
    {
        $beerManager = new BeerManager();

        $this->assertInstanceOf(Beer::class, $beerManager->createBeer());
        $this->assertSame('KBS', $beerManager->createMutableBeer()->getName());
    }
}
