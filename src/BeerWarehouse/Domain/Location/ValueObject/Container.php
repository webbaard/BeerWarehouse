<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\ValueObject;

final class Container
{
    /** @var string  */
    private $container;

    /**
     * @param string $container
     * @return Container
     */
    public static function fromString(string $container): Container
    {
        return new self($container);
    }

    /**
     * Container constructor.
     * @param string $container
     */
    private function __construct(string $container)
    {
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->container;
    }
}