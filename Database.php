<?php

class Database
{
    protected PDO $connection;

    public function __construct(array $config, string $username = 'root', string $password = '')
    {
        try {
            $dsn = 'mysql:' . http_build_query($config, '', ';');
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            handleException($e);
        }
    }

    public function query(string $query): PDOStatement
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute();
            return $statement;
        } catch (PDOException $e) {
            handleException($e);
        }
    }
}
