<?php
declare(strict_types=1);

namespace Tests\Webbaard\Immutability\Reflection;

use PHPUnit\Framework\TestCase;
use Webbaard\Immutability\Reflection\Beer;
use Webbaard\Immutability\Reflection\BeerManager;

class BeerManagerTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testBeerManager()
    {
        $beerManager = new BeerManager();

        $this->assertInstanceOf(Beer::class, $beerManager->createBeer());
        $this->assertSame('KBS', $beerManager->createBeer()->getName());
    }
}
