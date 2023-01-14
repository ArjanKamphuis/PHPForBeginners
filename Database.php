<?php

class Database
{
    protected PDO $connection;

    public function __construct()
    {
        try {
            $dsn = 'mysql:host=localhost;port=3306;dbname=phpforbeginners;user=root;charset=utf8mb4';
            $this->connection = new PDO($dsn);
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function query(string $query): PDOStatement
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute();
            return $statement;
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }
}
