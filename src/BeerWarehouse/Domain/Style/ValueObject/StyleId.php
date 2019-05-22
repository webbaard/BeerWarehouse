<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Style\ValueObject;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class StyleId
{
    /** @var UuidInterface  */
    private $uuid;

    /**
     * @param string $todoId
     * @return StyleId
     */
    public static function fromString(string $todoId): StyleId
    {
        return new self(Uuid::fromString($todoId));
    }

    /**
     * StyleId constructor.
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
