<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Style\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\LocationId;
use Webbaard\BeerWarehouse\Domain\Style\ValueObject\StyleId;

final class RemoveStyle extends Command implements PayloadConstructable
{
    use PayloadTrait;

    /**
     * @return StyleId
     */
    public function styleId(): StyleId
    {
        return StyleId::fromString($this->payload['id']);
    }

    /**
     * @param array $payload
     */
    protected function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
