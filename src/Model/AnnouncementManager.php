<?php

namespace App\Model;

use PDO;

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
     * Update announcement in database
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
        $addWhere = ' (`date_end` > NOW() OR `date_end` IS NULL)';
        if ($where) {
            if (isset($where['search'])) {
                $addWhere .= " AND (city LIKE '%" . $where['search'] . "%' OR message LIKE '%" . $where['search'] . "%'
                 OR title LIKE '%" . $where['search'] . "%' OR lastname LIKE '%" . $where['search'] . "%')";
            } else {
                foreach ($where as $key => $value) {
                    if ($key != 'limitQuery') {
                        $addWhere .= " AND `" . $key . "`='" . $value . "'";
                    }
                }
            }
        }
        $query = "SELECT ann.id, `region_id`, `author_id`, `message`, `address`, `city`, `zipcode`, `date_start`,
        `date_end`, `title`, `image`, `lastname`, `firstname` FROM `" . self::TABLE . "` as ann
         INNER JOIN `author` ON ann.author_id=author.id WHERE" . $addWhere . " ORDER BY ann.id DESC" .
          (isset($where['limitQuery']) ? $where['limitQuery'] : '');
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * Info about event with given id
     */
    public function selectById(int $id): array|false
    {
        $query = "SELECT  ann.id, `region_id`, `author_id`, `message`, `address`, `city`, `zipcode`, `date_start`,
        `date_end`, `title`, `image`, `lastname`, `firstname`, `email` FROM `" . self::TABLE . "` as ann
         INNER JOIN `author` ON ann.author_id=author.id WHERE ann.id=" . $id;
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetch();
    }
    /**
     * Delete event with given id
     */
    public function deleteById(int $id): void
    {
        $image = $this->selectById($id)['image'];
        $query = "DELETE FROM `" . self::TABLE . "` WHERE id=" . $id;
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        unlink('assets/images/cards/' . $image);
    }
}
