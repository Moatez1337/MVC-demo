<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Character;
use App\Util\DatabaseConfig;
use App\Util\DatabaseConnector;
use PDO;

class CharacterRepository
{
    private PDO $dbConnection;

    public function __construct(DatabaseConfig $dbConfig)
    {
        $this->dbConnection = DatabaseConnector::getInstance($dbConfig)->getConnection();
    }

    public function findById(int $id): ?Character
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM characters WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data === false) {
            return null;
        }

        return $this->hydrateCharacter($data);
    }

    public function findAll(): array
    {
        $stmt = $this->dbConnection->query('SELECT * FROM characters');
        $charactersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $characters = [];
        foreach ($charactersData as $data) {
            $characters[] = $this->hydrateCharacter($data);
        }

        return $characters;
    }

    public function save(Character $character): void
    {
        $stmt = $this->dbConnection->prepare('
            INSERT INTO characters (name, class, level) 
            VALUES (:name, :class, :level)
        ');

        $name = $character->getName();
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $class = $character->getClass();
        $stmt->bindParam(':class', $class, PDO::PARAM_STR);
        $level = $character->getLevel();
        $stmt->bindParam(':level', $level, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function update(Character $character): void
    {
        $stmt = $this->dbConnection->prepare('
            UPDATE characters 
            SET name = :name, class = :class, level = :level 
            WHERE id = :id
        ');

        $id = $character->getId();
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $name = $character->getName();
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $class = $character->getClass();
        $stmt->bindParam(':class', $class, PDO::PARAM_STR);
        $level = $character->getLevel();
        $stmt->bindParam(':level', $level, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function delete(int $id): void
    {
        $stmt = $this->dbConnection->prepare('DELETE FROM characters WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function hydrateCharacter(array $data): Character
    {
        $character = new Character();
        $character->setId($data['id'])
            ->setName($data['name'])
            ->setClass($data['class'])
            ->setLevel($data['level']);

        return $character;
    }
}