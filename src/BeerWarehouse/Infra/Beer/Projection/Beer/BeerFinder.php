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
     * @return \Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findAll()
    {
        return $this->connection->query("SELECT * FROM " . Table::BEER);
    }
}
