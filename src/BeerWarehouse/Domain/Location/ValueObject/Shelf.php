<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\ValueObject;

final class Shelf
{
    /** @var string  */
    private $shelf;

    /**
     * @param string $shelf
     * @return Shelf
     */
    public static function fromString(string $shelf): Shelf
    {
        return new self($shelf);
    }

    /**
     * Shelf constructor.
     * @param string $shelf
     */
    private function __construct(string $shelf)
    {
        $this->shelf = $shelf;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->shelf;
    }
}