<?php

namespace App\Model;

use PDO;

class AddGoodealManager extends AbstractManager
{
    public const TABLE = 'announcement';

    /**
     * Insert new item in database
     */
    public function insert(array $announcement): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "(title, lastname, firstname, category, adress, region_id, city, zipcode, date_start, date_end, email, image, message) VALUES (:deal-name, :lastname, :firstname, :category, :adress, :region, :city, :zip-code, :start-date, :end-date, :email, :avatar, :description)");
        $statement->bindValue('title', $announcement['title'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function saveRecipe(array $recipe): void
    {
        $query = 'INSERT INTO recipe (title, description) VALUES (:title, :description)';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':title', $recipe["title"], \PDO::PARAM_STR);
        $statement->bindValue(':description', $recipe["description"], \PDO::PARAM_STR);
        $statement->execute();
    }


/*
    /**
     * Update item in database

    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

        return $statement->execute();
    }*/
}
