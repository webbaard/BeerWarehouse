<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Command;

use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\Location;

final class MoveBeer extends Command implements PayloadConstructable
{
    use PayloadTrait;

    /**
     * @param string $beerId
     * @param Location $location
     * @return MoveBeer
     */
    public static function fromWarehouse(
        string $beerId,
        Location $location
    ): MoveBeer {
        return new self([
            'beerId' => $beerId,
            'location' => $location
        ]);
    }

    /**
     * @return BeerId
     */
    public function beerId(): BeerId
    {
        return BeerId::fromString($this->payload['id']);
    }

    /**
     * @return Location
     */
    public function location(): Location
    {
        return Location::fromString($this->payload['location']);
    }

    /**
     * @param array $payload
     */
    protected function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
