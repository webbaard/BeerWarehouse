<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

final class Brewer
{
    /**
     * @var string
     */
    private $brewer;

    /**
     * @param string $brewer
     * @return Brewer
     */
    public static function fromString(string $brewer): Brewer
    {
        return new self($brewer);
    }

    /**
     * Brewer constructor.
     * @param string $brewer
     */
    private function __construct(string $brewer)
    {
        $this->brewer = $brewer;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->brewer;
    }
}
