<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\ValueObject;

final class Room
{
    /** @var string  */
    private $room;

    /**
     * @param string $room
     * @return Room
     */
    public static function fromString(string $room): Room
    {
        return new self($room);
    }

    /**
     * Room constructor.
     * @param string $room
     */
    private function __construct(string $room)
    {
        $this->room = $room;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->room;
    }
}