<?php

namespace User\Task6;

use PDO;
use PDOException;

class Database
{
    protected $host = 'localhost';
    protected $dbname = 'bookstore';
    protected $username = 'root';
    protected $password = '';

    private $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
