<?php

declare(strict_types=1);

namespace App\Container;

use App\Controller\CharacterController;
use App\Repository\CharacterRepository;
use App\Util\Database\DatabaseConfig;
use App\Util\Database\DatabaseConfigBuilder;

class DiContainer
{
    private array $services = [];
    private static ?DiContainer $instance = null;

    private function __construct()
    {
        $this->registerServices();
    }

    public static function getInstance(): DiContainer
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    private function registerServices(): void
    {
        $this->services[DatabaseConfig::class] = function () {
            return $this->makeDatabaseConfig();
        };
        $this->services[CharacterRepository::class] = function () {
            return $this->makeCharacterRepository();
        };
        $this->services[CharacterController::class] = function () {
            return $this->makeCharacterController();
        };
    }

    private function makeCharacterRepository(): CharacterRepository
    {
        return new CharacterRepository($this->makeDatabaseConfig());

    }

    private function makeCharacterController(): CharacterController
    {
        return new CharacterController($this->makeCharacterRepository());
    }

    private function makeDatabaseConfig(): DatabaseConfig
    {
        $dbConfigBuilder = new DatabaseConfigBuilder();
        $dbConfigBuilder->addUsername("root")
            ->addDbName("db")
            ->addHostname("db")
            ->addPassword("root")
            ->addPort("3306");

        return $dbConfigBuilder->getDbConfig();
    }

    public function get(string $service)
    {
        if (!isset($this->services[$service])) {
            throw new \Exception("Service not found: " . $service);
        }

        return $this->services[$service]();
    }

}