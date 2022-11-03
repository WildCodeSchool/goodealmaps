<?php

namespace App\Model;

use PDO;

class AddGoodealManager extends AbstractManager
{
     /**
     * Insert new item in database
     */
    public function insert(array $announcement): void
    {

        $statement = $this->pdo->prepare("SELECT id FROM region WHERE region_name=:region");
        $statement->bindValue(':region', $announcement['region'], PDO::PARAM_STR);
        $regionId = $statement->fetchAll();

        $statement = $this->pdo->prepare("SELECT id FROM author WHERE firstname=:firstname
        AND lastname=:lastname AND email=:email");
        $statement->bindValue(':firstname', $announcement['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':lastname', $announcement['lastname'], PDO::PARAM_STR);
        $statement->bindValue(':email', $announcement['email'], PDO::PARAM_STR);
        $authorId = $statement->fetchAll();



        $statement = $this->pdo->prepare("INSERT INTO announcement (region_id, title, message, adress,
        author_id, category, date, date_start, date_end, image, city, zipcode )
        VALUES (:region_id, :deal-name, :description, :adress, :author_id, :category, :date, :start-date,
        :end-date, :avatar, :city :zip-code)");
        $statement->bindValue(':region_id', $regionId, PDO::PARAM_INT);
        $statement->bindValue(':deal-name', $announcement['deal-name'], PDO::PARAM_STR);
        $statement->bindValue(':description', $announcement['description'], PDO:: PARAM_STR);
        $statement->bindValue(':adress', $announcement['adress'], PDO::PARAM_STR);
        $statement->bindValue(':author_id', $authorId, PDO::PARAM_STR);
        $statement->bindValue(':category', $announcement['category'], PDO::PARAM_STR);
        $statement->bindValue(':date', date("d-m-Y"), PDO::PARAM_STR);
        $statement->bindValue(':start-date', $announcement['start-date'], PDO::PARAM_STR);
        $statement->bindValue(':end-date', $announcement['end-date'], PDO::PARAM_STR);
        $statement->bindValue(':avatar', $announcement['avatar'], PDO::PARAM_STR);
        $statement->bindValue(':city', $announcement['city'], PDO::PARAM_STR);
        $statement->bindValue(':zip-code', $announcement['zip-code'], PDO::PARAM_INT);

        $statement->execute();

        $statement = $this->pdo->prepare("INSERT INTO author (email, firstname, lastname)
        VALUES (:email, :firstname :lastname)");
        $statement->bindValue(':email', $announcement['email'], PDO::PARAM_STR);
        $statement->bindValue(':firstname', $announcement['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':lastname', $announcement['lastname'], PDO::PARAM_STR);
        $statement->execute();
    }

    /*
    public function saveRecipe(array $recipe): void
    {
        $query = 'INSERT INTO recipe (title, description) VALUES (:title, :description)';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':title', $recipe["title"], \PDO::PARAM_STR);
        $statement->bindValue(':description', $recipe["description"], \PDO::PARAM_STR);
        $statement->execute();
    }
/*

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
