<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class BeerStyle
{
    /**
     * @var string
     */
    private $style;

    /**
     * @param string $style
     * @return BeerStyle
     */
    public static function fromString(string $style): BeerStyle
    {
        return new self($style);
    }

    /**
     * BeerStyle constructor.
     * @param string $style
     */
    private function __construct(string $style)
    {
        $this->style = $style;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->style;
    }
}
