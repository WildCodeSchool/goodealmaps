<?php

namespace App\Model;

use PDO;
use PDOException;

/**
 * This class make a PDO object instanciation.
 */
class Connection
{
    private PDO $connection;
    private string $user;
    private string $host;
    private string $password;
    private string $database;

    public function __construct()
    {
        $this->user = DB_USER;
        $this->$host = DB_HOST;
        $this->$password = DB_PASSWORD;
        $this->$database = DB_NAME;
        try {
        $this->connection = new PDO(
            'mysql:host=' . $this->host . '; dbname=' . $this->database . '; charset=utf8',
            $this->user,
            $this->password
        );
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        if (ENV === 'dev') {
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    } catch (PDOException $e) {
        echo '<div class="error">Error !: ' . $e->getMessage() . '</div>';
    }
    }

    public function getconnection(): PDO
    {
        return $this->connection;
    }
}
