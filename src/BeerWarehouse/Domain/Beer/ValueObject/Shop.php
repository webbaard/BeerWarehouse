<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class Shop
{
    /**
     * @var string
     */
    private $shop;

    /**
     * @param string $shop
     * @return Shop
     */
    public static function fromString(string $shop): Shop
    {
        return new self($shop);
    }

    /**
     * Shop constructor.
     * @param string $shop
     */
    private function __construct(string $shop)
    {
        $this->shop = $shop;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->shop;
    }
}
