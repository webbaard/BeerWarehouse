<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\Container;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\Room;
use Webbaard\BeerWarehouse\Domain\Location\ValueObject\Shelf;

final class AddLocation extends Command implements PayloadConstructable
{
    use PayloadTrait;

    /**
     * @param string $room
     * @param string $container
     * @param string $shelf
     * @return AddLocation
     */
    public static function toLocations(
        string $room,
        string $container,
        string $shelf
    ): AddLocation {
        return new self([
            'room' => $room,
            'container' => $container,
            'shelf' => $shelf
        ]);
    }

    /**
     * @return Room
     */
    public function room(): Room
    {
        return Room::fromString($this->payload['room']);
    }

    /**
     * @return Container
     */
    public function container(): Container
    {
        return Container::fromString($this->payload['container']);
    }

    /**
     * @return Shelf
     */
    public function shelf(): Shelf
    {
        return Shelf::fromString($this->payload['shelf']);
    }

    /**
     * @param array $payload
     */
    protected function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
