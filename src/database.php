<?php

class Database
{
    private static $instance;

    private $conn;

    private function __construct()
    {
        $mysqlHost = getenv('MYSQL_HOST');
        $mysqlDb = getenv('MYSQL_DB');
        $mysqlUser = getenv('MYSQL_USER');
        $mysqlPassword = getenv('MYSQL_PASSWORD');
        if (false === $mysqlHost || false === $mysqlDb || false === $mysqlUser || false === $mysqlPassword) {
            throw new \Exception('MySQL connection details not set');
        }
        $conn = new \PDO("mysql:host=$mysqlHost;dbname=$mysqlDb", $mysqlUser, $mysqlPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->conn = $conn;
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConn(): \PDO
    {
        return $this->conn;
    }
}
