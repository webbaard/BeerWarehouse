<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Style;

use Doctrine\DBAL\Connection;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Table;

class StyleFinder
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * BeerFinder constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return mixed[]
     */
    public function findAll()
    {
        $styles = $this->connection->fetchAll(
            sprintf(
                'SELECT * FROM %s',
                Table::STYLE
            )
        );

        return $styles;
    }

    public function findById($id)
    {
        $style = $this->connection->fetchAssoc(
            sprintf(
                'SELECT * FROM %s WHERE id = "%s"',
                Table::STYLE,
                $id
            )
        );

        return $style;
    }
}
