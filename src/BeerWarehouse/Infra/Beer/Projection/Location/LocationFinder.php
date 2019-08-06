<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Location;

use Doctrine\DBAL\Connection;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Table;

class LocationFinder
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
        $locations = $this->connection->fetchAll(
            sprintf(
                'SELECT * FROM %s',
                Table::LOCATION
            )
        );

        return $locations;
    }

    public function findById($id)
    {
        $location = $this->connection->fetchAssoc(
            sprintf(
                'SELECT * FROM %s WHERE id = "%s"',
                Table::LOCATION,
                $id
            )
        );

        return $location;
    }
}
