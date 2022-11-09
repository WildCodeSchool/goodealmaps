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
}
