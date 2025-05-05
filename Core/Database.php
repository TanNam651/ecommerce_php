<?php

namespace Core;

use PDO;

class Database
{
    public static ?PDO $connection = null;
    public $statement;

    public function __construct($config, $username = 'root', $password = '06052001')
    {

        $dns = "mysql:" . http_build_query($config['database'], '', ';');

        self::$connection = new PDO($dns, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

//    public static function getConnection(): PDO
//    {
//        if (self::$connection !== null) {
//            return self::$connection;
//        } else {
//            return self::$connection;
//        }
//    }

    public function createTransaction(): void
    {
        self::$connection->beginTransaction();
    }

    public function endCommit(): void
    {
        self::$connection->commit();
    }

    public function endRollBack(): void
    {
        self::$connection->rollBack();
    }

    public function query($query, $params = [])
    {
        $this->statement = self::$connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    public function bind($params, $search):void
    {
        $this->statement->bindValue($params, $search, PDO::PARAM_STR);
    }

    public function find(): void
    {
        $this->statement->fetch();
    }

}