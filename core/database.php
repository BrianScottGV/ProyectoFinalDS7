<?php
require_once 'Config.php';

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $this->connection = new mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASS);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        // Create database if it doesn't exist
        $dbName = Config::DB_NAME;
        $check = $this->connection->query("SHOW DATABASES LIKE '$dbName'");
        if ($check->num_rows == 0) {
            $this->connection->query("CREATE DATABASE $dbName");
        }

        $this->connection->select_db($dbName);

        // Execute init.sql to create tables if they don't exist
        $sql = file_get_contents(__DIR__ . '/../sql/init.sql');
        if (!$this->connection->multi_query($sql)) {
            die("Error executing init.sql: " . $this->connection->error);
        }
        // Consume results of multi_query
        while ($this->connection->next_result()) {
            if (!$this->connection->more_results()) break;
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
}

?>