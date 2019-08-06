<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer;

use Doctrine\DBAL\Connection;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Table;

class BeerFinder
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
        $beers = $this->connection->fetchAll(
            sprintf(
                'SELECT * FROM %s',
                Table::BEER
            )
        );

        return $beers;
    }

    public function findById($id)
    {
        $beer = $this->connection->fetchAssoc(
            sprintf(
                'SELECT * FROM %s WHERE id = "%s"',
                Table::BEER,
                $id
            )
        );

        return $beer;
    }
}
