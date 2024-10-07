<?php

declare(strict_types=1);

namespace App\Util;

class DatabaseConfig
{

    private string $username;
    private string $password;
    private string $host;
    private string $port;
    private string $dbName;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    public function getPort(): string
    {
        return $this->port;
    }

    public function setPort(string $port): void
    {
        $this->port = $port;
    }

    public function getDbName(): string
    {
        return $this->dbName;
    }

    public function setDbName(string $dbName): void
    {
        $this->dbName = $dbName;
    }
}