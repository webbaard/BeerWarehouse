<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Domain\Style;

use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Ramsey\Uuid\Uuid;
use Webbaard\BeerWarehouse\Domain\Style\Event\StyleAdded;
use Webbaard\BeerWarehouse\Domain\Style\Event\StyleRemoved;
use Webbaard\BeerWarehouse\Domain\Style\ValueObject\Name;
use Webbaard\BeerWarehouse\Domain\Style\ValueObject\RemovedDate;
use Webbaard\BeerWarehouse\Domain\Style\ValueObject\StyleId;

final class Style extends AggregateRoot
{

    /** @var StyleId */
    private $styleId;

    /** @var Name */
    private $name;

    /** @var RemovedDate */
    private $removed;

    /**
     * @param Name $name
     * @return Style
     * @throws \Exception
     */
    public static function fromDescription(
        Name $name
    ): Style
    {
        $self = new self();
        $self->styleId = StyleId::fromString(Uuid::uuid4()->toString());
        $self->recordThat(StyleAdded::withData($self->styleId, $name));
        return $self;
    }

    public function remove(): void
    {
        $this->recordThat(StyleRemoved::now($this->styleId));
    }

    /**
     * @return string
     */
    protected function aggregateId(): string
    {
        return $this->styleId->toString();
    }

    /**
     * @param StyleAdded $event
     */
    protected function whenStyleWasAdded(StyleAdded $event): void
    {
        $this->styleId = StyleId::fromString($event->aggregateId());
        $this->name = $event->name();
    }

    /**
     * @param StyleRemoved $event
     */
    protected function whenStyleWasRemoved(StyleRemoved $event): void
    {
        $this->removed = $event->removed();
    }

    /**
     * @param AggregateChanged $event
     */
    protected function apply(AggregateChanged $event): void
    {
        switch (true) {
            case $event instanceof StyleAdded:
                $this->whenStyleWasAdded($event);
                break;
            case $event instanceof StyleRemoved:
                $this->whenStyleWasRemoved($event);
                break;
        }
    }
}
