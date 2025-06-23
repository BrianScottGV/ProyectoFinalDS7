<?php
require_once 'Config.php';

class Database {
    private static ?PDO $connection = null;

    public static function getConnection(): PDO {
        if (self::$connection === null) {
            $dsn = "mysql:host=" . Config::DB_HOST . ";charset=utf8mb4";
            self::$connection = new PDO($dsn, Config::DB_USER, Config::DB_PASS);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Crear base si no existe
            $dbName = Config::DB_NAME;
            $check = self::$connection->query("SHOW DATABASES LIKE '$dbName'");
            if ($check->rowCount() == 0) {
                $sql = file_get_contents(__DIR__ . '/../sql/init.sql');
                self::$connection->exec($sql);
            }

            self::$connection->query("USE $dbName");
        }
        return self::$connection;
    }
}