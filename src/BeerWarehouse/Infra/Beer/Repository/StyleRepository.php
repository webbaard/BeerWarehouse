<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Repository;

use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Webbaard\BeerWarehouse\Domain\Style\Repository\Styles;
use Webbaard\BeerWarehouse\Domain\Style\Style;
use Webbaard\BeerWarehouse\Domain\Style\ValueObject\StyleId;

final class StyleRepository extends AggregateRepository implements Styles
{
    /**
     * @param Style $style
     */
    public function save(Style $style): void
    {
        $this->saveAggregateRoot($style);
    }

    /**
     * @param StyleId $styleId
     * @return Style|object
     */
    public function getStyle(StyleId $styleId): Style
    {
        return $this->getAggregateRoot($styleId->toString());
    }
}













