<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Location\ValueObject;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class LocationId
{
    /** @var UuidInterface  */
    private $uuid;

    /**
     * @param string $todoId
     * @return LocationId
     */
    public static function fromString(string $todoId): LocationId
    {
        return new self(Uuid::fromString($todoId));
    }

    /**
     * LocationId constructor.
     * @param UuidInterface $uuid
     */
    private function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->uuid->toString();
    }
}
