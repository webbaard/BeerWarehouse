<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Beer\Projection\Style;

use Doctrine\DBAL\Connection;
use Prooph\EventStore\Projection\AbstractReadModel;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\Table;

class StyleReadModel extends AbstractReadModel
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
        $tableName = Table::STYLE;
        $sql = <<<EOT
CREATE TABLE `$tableName` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
        $tableName = Table::STYLE;
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
        $tableName = Table::STYLE;
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
        $tableName = Table::STYLE;
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
        $this->connection->update(Table::STYLE, $data, ['id' => $data['id']]);
    }

    /**
     * @param array $data
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function insert(array $data): void
    {
        $this->connection->insert(Table::STYLE, $data);

    }

    /**
     * @param array $data
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     */
    protected function remove(array $data): void
    {
        $this->connection->delete(Table::STYLE, ['id' => $data['id']]);
    }
}
