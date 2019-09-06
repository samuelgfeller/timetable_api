<?php
namespace App\Infrastructure\Persistence;

use Cake\Database\Connection;

abstract class DataManager {

    protected $conn = null;

    public function __construct(Connection $conn = null) {
        $this->conn = $conn;
    }

    public function findAll($table)
    {
        $query = $this->conn->newQuery();
        $query = $query->select('*')->from($table);
        // fetch all rows as array
        $rows = $query->execute()->fetchAll('assoc') ?: [];
        return $rows;
    }
}
