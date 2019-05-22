<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class BeerName
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     * @return BeerName
     */
    public static function fromString(string $name): BeerName
    {
        return new self($name);
    }

    /**
     * BeerName constructor.
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->name;
    }
}
