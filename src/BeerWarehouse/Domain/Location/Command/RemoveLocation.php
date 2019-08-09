<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\LocationId;

final class RemoveLocation extends Command implements PayloadConstructable
{
    use PayloadTrait;

    /**
     * @return LocationId
     */
    public function locationId(): LocationId
    {
        return LocationId::fromString($this->payload['id']);
    }

    /**
     * @param array $payload
     */
    protected function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
