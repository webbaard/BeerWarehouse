<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Beer;

use Doctrine\DBAL\Connection;
use Prooph\EventStore\Projection\AbstractReadModel;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Table;

class BeerReadModel extends AbstractReadModel
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * ProductReadModel constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * void
     * @throws \Doctrine\DBAL\DBALException
     */
    public function init(): void
    {
        $tableName = Table::BEER;
        $sql = <<<EOT
CREATE TABLE `$tableName` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `brewer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shop` varchar(255) COLLATE utf8_unicode_ci NULL,
  `style` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bought_on` dateTime COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
EOT;
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public function isInitialized(): bool
    {
        $tableName = Table::BEER;
        $sql = "SHOW TABLES LIKE '$tableName';";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetch();
        if (false === $result) {
            return false;
        }

        return true;
    }

    /**
     * void
     * @throws \Doctrine\DBAL\DBALException
     */
    public function reset(): void
    {
        $tableName = Table::BEER;
        $sql = "DROP TABLE IF EXISTS $tableName;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    /**
     * void
     * @throws \Doctrine\DBAL\DBALException
     */
    public function delete(): void
    {
        $tableName = Table::BEER;
        $sql = "DROP TABLE IF EXISTS $tableName;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    /**
     * @param array $data
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function update(array $data): void
    {
        $this->connection->update(Table::BEER, $data, ['id' => $data['id']]);
    }

    /**
     * @param array $data
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function insert(array $data): void
    {
        $this->connection->insert(Table::BEER, $data);

    }

    /**
     * @param array $data
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     */
    protected function remove(array $data): void
    {
        $this->connection->delete(Table::BEER, ['id' => $data['id']]);
    }
}
