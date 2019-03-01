<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class BeerStyle
{
    private $style;
    public static function fromString(string $style): BeerStyle
    {
        return new self($style);
    }

    private function __construct(string $style)
    {
        $this->style = $style;
    }
}
