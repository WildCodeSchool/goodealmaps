<?php

namespace App\Model;

use PDO;
use App\Model\AuthorManager;
use App\Model\RegionManager;

class AddGoodealManager extends AbstractManager
{
    public const TABLE = 'announcement';
     /**
     * Insert new item in database
     */
    public function insertGoodeal(array $announcement): void
    {
        $regionManager = new RegionManager();
        $regionId = $regionManager->selectRegionId($announcement['region']);

        $authorManager = new AuthorManager();
        $authorId = $authorManager->selectAuthorId(
            $announcement['firstname'],
            $announcement['lastname'],
            $announcement['email']
        );

        if ($announcement['start-date'] === "") {
            $startDate = null;
        } else {
            $startDate = $announcement['start-date'];
        }

        if ($announcement['end-date'] === "") {
            $endDate = null;
        } else {
            $endDate = $announcement['end-date'];
        }

        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (region_id, title, message, address,
        author_id, category, date, date_start, date_end, image, city, zipcode)
        VALUES (:region_id, :title, :message, :address, :author_id, :category, :date, :date_start,
        :date_end, :image, :city, :zipcode)");
        $statement->bindValue(':region_id', $regionId, PDO::PARAM_INT);
        $statement->bindValue(':title', $announcement['title'], PDO::PARAM_STR);
        $statement->bindValue(':message', $announcement['message'], PDO:: PARAM_STR);
        $statement->bindValue(':address', $announcement['address'], PDO::PARAM_STR);
        $statement->bindValue(':author_id', $authorId, PDO::PARAM_INT);
        $statement->bindValue(':category', $announcement['category'], \PDO::PARAM_STR);
        $statement->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
        $statement->bindValue(':date_start', $startDate, PDO::PARAM_STR);
        $statement->bindValue(':date_end', $endDate, PDO::PARAM_STR);
        $statement->bindValue(':image', $announcement['image'], PDO::PARAM_STR);
        $statement->bindValue(':city', $announcement['city'], PDO::PARAM_STR);
        $statement->bindValue(':zipcode', $announcement['zipcode'], PDO::PARAM_INT);


        $statement->execute();
    }

    public function updateGoodeal(array $updategoodeal): void
    {
        $regionManager = new RegionManager();
        $regionId = $regionManager->selectRegionId($updategoodeal['region']);

        $authorManager = new AuthorManager();
        $authorId = $authorManager->selectAuthorId(
            $updategoodeal['firstname'],
            $updategoodeal['lastname'],
            $updategoodeal['email']
        );

        if ($updategoodeal['startDate'] === "") {
            $startDate = null;
        } else {
            $startDate = $updategoodeal['startDate'];
        }

        if ($updategoodeal['endDate'] === "") {
            $endDate = null;
        } else {
            $endDate = $updategoodeal['endDate'];
        }

        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET region_id = :region_id, 
        title = :title, message = :message, address = :address, 
        author_id = :author_id, category = :category, date = :date, 
        date_start = :date_start, date_end = :date_end, image = :image, 
        city = :city, zipcode = :zipcode WHERE id = :id");
        $statement->bindValue(':region_id', $regionId, PDO::PARAM_INT);
        $statement->bindValue(':title', $updategoodeal['title'], PDO::PARAM_STR);
        $statement->bindValue(':message', $updategoodeal['message'], PDO:: PARAM_STR);
        $statement->bindValue(':address', $updategoodeal['address'], PDO::PARAM_STR);
        $statement->bindValue(':author_id', $authorId, PDO::PARAM_INT);
        $statement->bindValue(':category', $updategoodeal['category'], \PDO::PARAM_STR);
        $statement->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
        $statement->bindValue(':date_start', $startDate, PDO::PARAM_STR);
        $statement->bindValue(':date_end', $endDate, PDO::PARAM_STR);
        $statement->bindValue(':image', $updategoodeal['image'], PDO::PARAM_STR);
        $statement->bindValue(':city', $updategoodeal['city'], PDO::PARAM_STR);
        $statement->bindValue(':zipcode', $updategoodeal['zipcode'], PDO::PARAM_INT);
        $statement->bindValue(':id', $updategoodeal["id"], \PDO::PARAM_INT);

        $statement->execute();
    }
}
