<?php

declare(strict_types=1);

namespace Core\Model;

use Core\Model\Data\DataModelInterface;
use Exception;
use PDO;

/**
 * Working with DB class
 */
abstract class ResourceModel
{
    protected string $tableName;
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=' . MARIADB_HOST . ';dbname=' . MARIADB_DATABASE,
            MARIADB_USER,
            MARIADB_PASSWORD
        );
    }


    /**
     * Delete from table by provided param
     *
     * @param string $columnName
     * @param mixed $columnValue
     * @return void
     */
    public function deleteByColumn(string $columnName, mixed $columnValue): void
    {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $columnName . ' = ?';
        $statement = $this->connection->prepare($sql);
        $statement->execute([$columnValue]);
    }

    public function getAllByFilters(array $filters, array $ordering = null): array
    {
        $filterKeys = array_keys($filters);
        $whereStatement = implode(
            ' AND ',
            array_map(fn(string $filterKeys) => $filterKeys . ' = ?', $filterKeys));

        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $whereStatement;
        if ($ordering !== null) {
            $sql .= 'ORDER BY ' . implode(' ',$ordering);
        }
        $statement = $this->connection->prepare($sql);
        $statement->execute(array_values($filters));
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * @param DataModelInterface $dataModel
     * @return void
     * @throws Exception
     */
    public function insert(DataModelInterface $dataModel): void
    {
        $data = $dataModel->getData();
        $dataColumns = array_keys($data);
        $sql = 'INSERT INTO ' . $this->tableName
            . ' (' . implode(', ', $dataColumns) . ') '
            . ' VALUES (' . implode(', ', array_map(fn($dataItem) => ':' . $dataItem, $dataColumns)) . ')';

        $statement = $this->connection->prepare($sql);
        foreach ($data as $dataItemColumn => $dataItemValue) {
            $statement->bindValue(':' . $dataItemColumn, $dataItemValue);
        }
        $insertedCount = $statement->execute();
        if (!$insertedCount) {
            throw new Exception('Nothing has inserted in DB');
        }
        $dataModel->setId((int)$this->connection->lastInsertId());
    }


    /**
     * Load model from DB
     *
     * @param DataModelInterface $dataModel
     * @param string $column - column name
     * @param mixed $value
     * @return void
     */
    public function loadDataModel(DataModelInterface $dataModel, string $column, mixed $value): void
    {
        $dataColumns = array_keys($dataModel->getData());
        $sql = 'SELECT ' . implode(', ', $dataColumns) . ' FROM ' . $this->tableName . ' WHERE ' . $column . ' = ? LIMIT 1';
        $statement = $this->connection->prepare($sql);
        $statement->execute([$value]);
        $result = $statement->fetch();
        if ($result !== false) {
            $dataModel->setData($result);
        }
    }

    /**
     * Get COUNT(*) result based on WHERE conditions
     *
     * @param string $whereStatement
     * @param array $binds
     * @return int
     */
    public function getCountResult(string $whereStatement, array $binds): int
    {
        $sql = 'SELECT COUNT(*) FROM ' . $this->tableName
            . ' WHERE ' . $whereStatement;
        $statement = $this->connection->prepare($sql);
        $statement->execute($binds);

        return $statement->fetchColumn();
    }
}