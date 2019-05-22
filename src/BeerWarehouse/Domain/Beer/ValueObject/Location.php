<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class Location
{
    /**
     * @var string
     */
    private $location;

    /**
     * @param string $location
     * @return Location
     */
    public static function fromString(string $location): Location
    {
        return new self($location);
    }

    /**
     * Location constructor.
     * @param string $location
     */
    private function __construct(string $location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->location;
    }
}