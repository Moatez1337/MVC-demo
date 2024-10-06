<?php

declare(strict_types=1);

namespace App\Util;

class DatabaseConfigBuilder implements Builder
{

    private DatabaseConfig $dbConfig;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->dbConfig = new DatabaseConfig();
    }

    public function addUsername(string $username): Builder
    {
        $this->dbConfig->setUsername($username);
        return $this;
    }

    public function addPassword(string $password): Builder
    {
        $this->dbConfig->setPassword($password);
        return $this;
    }

    public function addHostname(string $hostName): Builder
    {
        $this->dbConfig->setHost($hostName);
        return $this;
    }

    public function addPort(string $port): Builder
    {
        $this->dbConfig->setPort($port);
        return $this;
    }

    public function addDbName(string $dbName): Builder
    {
        $this->dbConfig->setDbName($dbName);
        return $this;
    }
}