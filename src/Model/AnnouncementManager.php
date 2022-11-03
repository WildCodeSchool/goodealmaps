<?php

namespace App\Model;

class AnnouncementManager extends AbstractManager
{
    public const TABLE = 'announcement';


    /**
     * Insert new announcement in database
     */

    public function insert(array $item): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update announsment in database
     */
    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * List of events
     */
    public function select(array $where = []): array
    {
        $addWhere = ' 1';
        if ($where) {            
            foreach ($where as $key => $value) {
                if ($key != 'limitQuery') {
                    $addWhere .= " AND `" . $key . "`='" . $value . "'";
                }
            }            
        }
        $query = "SELECT * FROM `" . self::TABLE . "` as ann
         INNER JOIN `author` ON ann.author_id=author.id WHERE" . $addWhere. " ORDER BY ann.id DESC" .
          (isset($where['limitQuery']) ? $where['limitQuery'] : '');//echo $query;
        $statement = $this->pdo->prepare($query);        
        $statement->execute();
        return $statement->fetchAll();
    }
}
