<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\Command;

use Webbaard\BeerWarehouse\Domain\Beer\ValueObject\BeerId;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

final class ConsumeBeer extends Command implements PayloadConstructable
{
    use PayloadTrait;

    /**
     * @param string $beerId
     * @return ConsumeBeer
     */
    public static function fromWarehouse(
        string $beerId
    ): ConsumeBeer {
        return new self([
            'beerId' => $beerId
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
     * @param array $payload
     */
    protected function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
