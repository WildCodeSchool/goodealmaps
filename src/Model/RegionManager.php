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
}
