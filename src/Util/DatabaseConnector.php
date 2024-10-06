<?php

declare(strict_types=1);

namespace App\Util;

class DatabaseConnector{

    private DatabaseConfig $dbConfig;

    public function __construct(DatabaseConfig $dbConfig){
        $this->dbConfig = $dbConfig;
    }
}