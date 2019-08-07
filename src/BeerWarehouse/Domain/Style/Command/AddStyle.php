<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Style\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Webbaard\BeerWarehouse\Domain\Style\ValueObject\Name;

final class AddStyle extends Command implements PayloadConstructable
{
    use PayloadTrait;

    /**
     * @param string $name
     * @return AddStyle
     */
    public static function toStyles(
        string $name
    ): AddStyle {
        return new self([
            'name' => $name
        ]);
    }

    /**
     * @return Name
     */
    public function name(): Name
    {
        return Name::fromString($this->payload['name']);
    }

    /**
     * @param array $payload
     */
    protected function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
