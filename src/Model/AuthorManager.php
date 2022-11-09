<?php

namespace App\Model;

use PDO;

class AuthorManager extends AbstractManager
{
    public const TABLE = 'author';

    /**
     * List of regions
     */
    public function selectAllAuthor(): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM `" . self::TABLE . "`");
        $statement->execute();
        return $statement->fetchAll();
    }
    public function selectAuthorId(string $firstname, string $lastname, string $email): int
    {
        $statement = $this->pdo->prepare("SELECT id FROM " . self::TABLE . " WHERE firstname=:firstname
        AND lastname=:lastname AND email=:email");
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();
        $authorId = $statement->fetch();
        return $authorId['id'];
    }

    public function insertAuthor(array $announcement): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (email, firstname, lastname)
        VALUES (:email, :firstname, :lastname)");
        $statement->bindValue(':email', $announcement['email'], \PDO::PARAM_STR);
        $statement->bindValue(':firstname', $announcement['firstname'], \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $announcement['lastname'], \PDO::PARAM_STR);
        $statement->execute();
    }

    function autorExists(array $author): bool | array
    {
        $statement = $this->pdo->prepare("SELECT id FROM " . self::TABLE . " WHERE firstname=:firstname
        AND lastname=:lastname AND email=:email");
        $statement->bindValue(':firstname', $author['firstname'], \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $author['lastname'], \PDO::PARAM_STR);
        $statement->bindValue(':email', $author['email'], \PDO::PARAM_STR);
        $statement->execute();
        $authorIdReal = $statement->fetch();

        return $authorIdReal;

    }
}
