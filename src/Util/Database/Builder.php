<?php

declare(strict_types=1);

namespace App\Util\Database;

interface Builder
{

    public function reset(): void;

    public function addUsername(string $username): Builder;

    public function addPassword(string $password): Builder;

    public function addHostname(string $hostName): Builder;

    public function addPort(string $port): Builder;

    public function addDbName(string $dbName): Builder;
}