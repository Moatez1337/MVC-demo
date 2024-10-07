<?php

declare(strict_types=1);

namespace App\Container;

use App\Util\DatabaseConfig;
use App\Util\DatabaseConfigBuilder;

class DatabaseContainer
{
    private DatabaseConfig $dbConfig;

    public function __construct()
    {
        $this->makeDbConfig();
    }
    public function makeDbConfig(): void
    {
        $dbConfigBuilder = new DatabaseConfigBuilder();
        $dbConfigBuilder->addUsername("root")
            ->addDbName("db")
            ->addHostname("db")
            ->addPassword("root")
            ->addPort("3306");
        $this->dbConfig = $dbConfigBuilder->getDbConfig();
    }

    public function getDbConfig(): DatabaseConfig
    {
        return $this->dbConfig;
    }
}