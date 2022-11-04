<?php

namespace App\Model;

use PDO;

class AboutManager extends AbstractManager
{
    public const TABLE = 'devs';

    /**
     * return devs info
     */
    public function renderDevs(): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM `" . self::TABLE . "`");
        $statement->execute();
        return $statement->fetchAll();
    }
}
