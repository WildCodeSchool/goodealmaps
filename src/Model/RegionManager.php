<?php

namespace App\Model;

use PDO;

class RegionManager extends AbstractManager
{
    public const TABLE = 'region';

    /**
     * List of regions
     */
    public function select(): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM `" . self::TABLE . "`");
        $statement->execute();
        return $statement->fetchAll();
    }
    public function selectRegionById(string $name): int
    {
        $statement = $this->pdo->prepare("SELECT id FROM " . self::TABLE . " WHERE region_name=:region");
        $statement->bindValue(':region', $name, \PDO::PARAM_STR);
        $regionId = $statement->fetch();
        return $regionId;
    }
}
