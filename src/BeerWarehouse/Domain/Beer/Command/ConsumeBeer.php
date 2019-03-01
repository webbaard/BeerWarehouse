<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Command;

use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerName;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerStyle;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Brewer;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Location;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

final class ConsumeBeer extends Command implements PayloadConstructable
{
    use PayloadTrait;
    public static function forWarehouse(
        string $beerId
    ): ConsumeBeer {
        return new self([
            'beerId' => $beerId
        ]);
    }

    public function beerId(): BeerId
    {
        return BeerId::fromString($this->payload['id']);
    }

    protected function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
