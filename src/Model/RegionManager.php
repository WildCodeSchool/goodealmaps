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
/*    public function selectRegionById($announcement): int
    {
        $statement = $this->pdo->prepare("SELECT id FROM " . self::TABLE . " WHERE region_name=:region");
        $statement->bindValue(':region', $announcement['region'], \PDO::PARAM_STR);
        $regionId = $statement->fetchAll();
    }*/
}
