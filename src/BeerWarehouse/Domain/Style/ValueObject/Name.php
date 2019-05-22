<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Style\ValueObject;

final class Name
{
    /** @var string  */
    private $name;

    /**
     * @param string $name
     * @return Name
     */
    public static function fromString(string $name): Name
    {
        return new self($name);
    }

    /**
     * Room constructor.
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