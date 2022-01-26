<?php

abstract class Database
{

    /**
     * Instance PDO
     * 
     * @var PDO
     */
    private static $pdo;

    public static function getInstance(): PDO
    {
        if (empty(self::$pdo)) {
            $host = DB_HOST;
            $name = DB_NAME;
            $user = DB_USER;
            $password = DB_PASSWORD;

            self::$pdo = new PDO(
                "mysql:host=$host;dbname=$name;charset=utf8",
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        }

        return self::$pdo;
    }
}
