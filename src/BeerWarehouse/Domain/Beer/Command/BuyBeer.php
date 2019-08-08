<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Command;

use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerName;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerStyle;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Brewer;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Location;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Shop;

final class BuyBeer extends Command implements PayloadConstructable
{
    use PayloadTrait;

    /**
     * @param string $brewer
     * @param string $name
     * @param string $style
     * @param string|null $shop
     * @param string|null $location
     * @return BuyBeer
     */
    public static function forWarehouse(
        string $brewer,
        string $name,
        string $style,
        ?string $shop = null,
        ?string $location = null
    ): BuyBeer {
        return new self([
            'brewer' => $brewer,
            'name' => $name,
            'shop' => $shop,
            'style' => $style,
            'location' => $location
        ]);
    }

    /**
     * @return Brewer
     */
    public function brewer(): Brewer
    {
        return Brewer::fromString($this->payload['brewer']);
    }

    /**
     * @return BeerName
     */
    public function name(): BeerName
    {
        return BeerName::fromString($this->payload['name']);
    }

    /**
     * @return Shop|null
     */
    public function shop(): ?Shop
    {
        if ($this->payload['shop']) {
            return Shop::fromString($this->payload['shop']);
        }
        return null;
    }

    /**
     * @return BeerStyle
     */
    public function style(): BeerStyle
    {
        return BeerStyle::fromString($this->payload['style']);
    }

    /**
     * @return Location|null
     */
    public function location(): ?Location
    {
        if ($this->payload['location']) {
            return Location::fromString($this->payload['location']);
        }
        return null;
    }

    /**
     * @param array $payload
     */
    protected function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
