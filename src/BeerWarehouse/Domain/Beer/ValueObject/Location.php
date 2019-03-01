<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class Location
{
    private $location;
    public static function fromString(string $location): Location
    {
        return new self($location);
    }

    private function __construct(string $location)
    {
        $this->location = $location;
    }
}