<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class Brewer
{
    private $brewer;
    public static function fromString(string $brewer): Brewer
    {
        return new self($brewer);
    }

    private function __construct(string $brewer)
    {
        $this->brewer = $brewer;
    }
}
