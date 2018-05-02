<?php
declare(strict_types=1);

namespace BeerWarehouse\Domain\Beer\ValueObject;

final class BeerName
{
    private $name;
    public static function fromString(string $name): BeerName
    {
        return new self($name);
    }

    private function __construct(string $name)
    {
        $this->name = $name;
    }
}
