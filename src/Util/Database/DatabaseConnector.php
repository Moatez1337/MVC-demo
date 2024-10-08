<?php

declare(strict_types=1);

namespace App\Util\Database;

use PDO;
use PDOException;

class DatabaseConnector
{

    private DatabaseConfig $dbConfig;
    private static ?DatabaseConnector $instance = null;
    private PDO $connection;

    private function __construct(DatabaseConfig $dbConfig)
    {
        $this->dbConfig = $dbConfig;
        $this->connectToDatabase();
    }

    public static function getInstance(DatabaseConfig $dbConfig): DatabaseConnector
    {
        if (self::$instance === null) {
            self::$instance = new self($dbConfig);
        }

        return self::$instance;
    }

    public function connectToDatabase(): void
    {
        try {
            $conn = $this->createConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection = $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    private function createConnection(): PDO
    {
        $host = $this->dbConfig->getHost();
        $username = $this->dbConfig->getUsername();
        $password = $this->dbConfig->getPassword();
        $dbName = $this->dbConfig->getDbName();

        return new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}