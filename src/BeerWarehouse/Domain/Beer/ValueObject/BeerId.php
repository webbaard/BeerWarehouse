<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Beer\ValueObject;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class BeerId
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @param string $todoId
     * @return BeerId
     */
    public static function fromString(string $todoId): BeerId
    {
        return new self(Uuid::fromString($todoId));
    }

    /**
     * BeerId constructor.
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
