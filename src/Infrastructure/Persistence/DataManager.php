<?php

namespace App\Infrastructure\Persistence;

use App\Infrastructure\Persistence\Exceptions\PersistenceRecordNotFoundException;
use Cake\Database\Connection;
use Cake\Database\Query;
use Cake\Database\StatementInterface;

abstract class DataManager
{
    
    private $connection = null;
    protected $table = null;
    
    public function __construct(Connection $connection = null)
    {
        $this->connection = $connection;
    }
    
    /**
     * Get a query instance with target table already set
     *
     * @return Query
     */
    public function newSelectQuery(): Query
    {
        return $this->connection->newQuery()->from($this->table);
    }
    
    /**
     * Return all rows in a database
     * Reason why empty array is returned if nothing: https://stackoverflow.com/a/11536281/9013718
     *
     * @return array
     */
    public function findAll(): array
    {
        $query = $this->newSelectQuery();
        $query = $query->select('*')
            ->where([
                'deleted_at' => null
            ]);
        return $query->execute()->fetchAll('assoc') ?: [];
    }
    
    /**
     * Searches entry in table which has given id
     * If not found it returns an empty array
     *
     * @param int $id
     * @return array []
     */
    public function findById(int $id): array
    {
        $query = $this->newSelectQuery();
        $query = $query->select()
            ->where([
                'deleted_at' => null,
                'id' => $id
            ]);
        return $query->execute()->fetch('assoc') ?: [];
    }
    
    /**
     * Searches entry in table with has given value at given column
     *
     * @param string $column
     * @param $value
     * @return array
     */
    public function findBy(string $column, $value): array
    {
        $query = $this->newSelectQuery();
        // Retrieving a single Row
        $query = $query->select()
            ->andWhere([
                'deleted_at' => null,
                $column => $value
            ]);
        // ?: returns the value on the left only if it is set and truthy (if not set it gives a notice)
        return $query->execute()->fetch('assoc') ?: [];
    }
    
    /**
     * Retrieve entry from table which has given id
     * If it doesn't find anything an error is thrown
     *
     * @param int $id
     * @return array
     * @throws PersistenceRecordNotFoundException
     */
    public function getById(int $id): array
    {
        $query = $this->newSelectQuery();
        $query = $query->select()
            ->where([
                'deleted_at' => null,
                'id' => $id
            ]);
        $entry = $query->execute()->fetch('assoc');
        if (!$entry) {
            $err = new PersistenceRecordNotFoundException();
            $err->setNotFoundElement($this->table);
            throw $err;
        }
        return $entry;
    }
    
    /**
     * Insert in database.
     *
     * @param array $row with data to insert
     * @return int
     */
    protected function insert(array $row): int
    {
        return $this->connection->insert($this->table, $row)->lastInsertId();
    }
    
    /**
     * Update database
     * Data is an assoc array of columns to change
     * Example: ['name' => 'New name']
     *
     * @param array $data
     * @param $whereIdIs
     * @return bool
     */
    protected function update(array $data, $whereIdIs): bool
    {
        $query = $this->connection->newQuery();
        $query->update($this->table)
            ->set($data)
            ->where([
                'id' => $whereIdIs
            ]);
        return $query->execute()->rowCount() > 0;
    }
    
    /**
     * Delete from database permanently (execute DELETE statement)
     *
     * @param $id
     *
     * @return bool
     */
    protected function hardDelete($id): bool
    {
        return $this->connection->delete($this->table, ['id' => $id])->rowCount() > 0;
    }
    
    /**
     * Soft delete entry with given id from database
     *
     * @param $id
     * @return bool
     */
    protected function delete($id): bool
    {
        $query = $this->connection->newQuery();
        $query->update($this->table)
            ->set(['deleted_at' => date('Y-m-d H:i:s')])
            ->where(['id' => $id]);
        return $query->execute()->rowCount() > 0;
    }
    
    /**
     * Check if value exists in database
     *
     * @param string $column
     * @param string $value
     * @return bool
     */
    public function exists(string $column, $value): bool
    {
        $query = $this->newSelectQuery();
        $query->select(1)->where([$column => $value]);
        $row = $query->execute()->fetch();
        return !empty($row);
    }
    
}
