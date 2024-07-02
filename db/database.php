<?php

/**
 * Database class, we use singleton design pattern to provide database connection
 */
class Database {

    protected static $connection;

    private array $config;

    public function  __construct($config) {
        $this->config = $config;
    }

    public function __destruct() {
        if (self::$connection) {
            mysqli_close(self::$connection);
        }
    }

    public function getConnection() {

        if (!self::$connection) {
                /** @var  array $config */
                $conn = new mysqli(
                    $this->config['db_host'],
                    $this->config['db_user'],
                    $this->config['db_pass'],
                    $this->config['db_name']
                );
                if ($conn->connect_errno) {
                    echo "Fail to connect to the database " . $conn->connect_error;
                    exit();
                }
                self::$connection = $conn;
        }
        return self::$connection;
    }

    public function close() : void {
        self::$connection->close();
    }

}