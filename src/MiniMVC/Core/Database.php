<?php

namespace MiniMVC\Core;

use PDO;
use PDOException;

class Database
{
    private $pdo;

    public function __construct()
    {
        $database = 'mysql:host=database:3306;dbname=docker;charset=utf8mb4';
        $user = getenv('MYSQL_USER');
        $pass = getenv('MYSQL_PASSWORD');

        if ($user === false || $pass === false) {
            throw new \RuntimeException('Database credentials not set in environment variables.');
        }

        try {
            $this->pdo = new PDO($database, $user, $pass);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
