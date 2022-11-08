<?php

namespace App\Model;

use PDO;
use App\Model\AuthorManager;
use App\Model\RegionManager;

/*use App\Model\RegionManager;
use App\Model\AuthorManager;*/

class AddGoodealManager extends AbstractManager
{
    public const TABLE = 'announcement';
     /**
     * Insert new item in database
     */
    public function insertGoodeal(array $announcement): void
    {
        $regionId = new RegionManager();
        $regionId->selectRegionById($announcement['region']);

        $authorId = new AuthorManager();
        $authorId->selectAuthorById($announcement['firstname'], $announcement['lastname'], $announcement['email']);

        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (region_id, title, message, adress,
        author_id, category, date, date_start, date_end, image, city, zipcode )
        VALUES (:region_id, :title, :message, :adress, :author_id, :category, :date, :date_start,
        :date_end, :image, :city :zipcode)");
        $statement->bindValue(':region_id', $regionId, \PDO::PARAM_INT);
        $statement->bindValue(':title', $announcement['title'], \PDO::PARAM_STR);
        $statement->bindValue(':message', $announcement['message'], \PDO:: PARAM_STR);
        $statement->bindValue(':adress', $announcement['adress'], \PDO::PARAM_STR);
        $statement->bindValue(':author_id', $authorId, PDO::PARAM_INT);
        $statement->bindValue(':category', $announcement['category'], \PDO::PARAM_STR);
        $statement->bindValue(':date', date("d-m-Y"), \PDO::PARAM_STR);
        $statement->bindValue(':date_start', $announcement['start-date'], \PDO::PARAM_STR);
        $statement->bindValue(':date_end', $announcement['end-date'], \PDO::PARAM_STR);
        $statement->bindValue(':image', $announcement['image'], \PDO::PARAM_STR);
        $statement->bindValue(':city', $announcement['city'], \PDO::PARAM_STR);
        $statement->bindValue(':zipcode', $announcement['zipcode'], \PDO::PARAM_INT);


        $statement->execute();

/*    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

        return $statement->execute();
    }*/
    }
}
