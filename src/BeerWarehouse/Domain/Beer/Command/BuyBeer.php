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

final class BuyBeer extends Command implements PayloadConstructable
{
    use PayloadTrait;
    public static function forWarehouse(
        string $brewer,
        string $name,
        string $style,
        ?string $location = null
    ): BuyBeer {
        return new self([
            'brewer' => $brewer,
            'name' => $name,
            'style' => $style,
            'location' => $location
        ]);
    }

    public function brewer(): Brewer
    {
        return Brewer::fromString($this->payload['brewer']);
    }
    public function name(): BeerName
    {
        return BeerName::fromString($this->payload['name']);
    }
    public function style(): BeerStyle
    {
        return BeerStyle::fromString($this->payload['style']);
    }
    public function location(): Location
    {
        return Location::fromString($this->payload['location']);
    }

    protected function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
