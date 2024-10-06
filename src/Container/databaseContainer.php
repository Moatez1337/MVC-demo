<?php

declare(strict_types=1);

namespace App\Container;

use App\Util\DatabaseConfig;
use App\Util\DatabaseConfigBuilder;

class databaseContainer
{
    private DatabaseConfig $dbConfig;

    public function __construct()
    {
        $dbConfig = new DatabaseConfigBuilder();
        $dbConfig->addUsername("root")
            ->addDbName("db")
            ->addHostname("127.0.0.1")
            ->addPassword("root")
            ->addPort("3306");

    }
}