<?php

namespace Framework;

use PDO;
use PDOStatement;

class Database
{
    private PDO $connection;

    public function __construct(string $name)
    {
        $this->connection = new PDO("sqlite:" . $name);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->connection->exec('PRAGMA foreign_keys = ON;');
    }

    public function query(string $sql): PDOStatement|false
    {
        return $this->connection->query($sql);
    }

    /**
     * @param string[] $params
     */
    public function run(string $sql, array $params = []): PDOStatement
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($params);
        return $statement;
    }

    public function prepare(string $sql): PDOStatement|false
    {
        return $this->connection->prepare($sql);
    }

    public function exec(string $sql): int|false
    {
        return $this->connection->exec($sql);
    }

    public function migrate(string $direction): void
    {
        $files = scandir($direction);
        if ($files === false) {
            die('Migrate file does not exist');
        }
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            echo 'Migrating' . $file . '\n';
            if ($contents = file_get_contents($direction . $file)) {
                $this->connection->exec($contents);
            }
        }
    }

    public function getLastId(string | null $field = null): int
    {
        return (int)$this->connection->lastInsertId($field);
    }
}