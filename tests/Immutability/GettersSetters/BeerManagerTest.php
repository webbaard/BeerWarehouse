<?php
declare(strict_types=1);

namespace Tests\Webbaard\Immutability\Constructor;

use PHPUnit\Framework\TestCase;
use Webbaard\Immutability\Constructor\Beer;
use Webbaard\Immutability\Constructor\BeerManager;

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
