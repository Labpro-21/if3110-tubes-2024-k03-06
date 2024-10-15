<?php
class Database {
    private $host = "db";
    private $db_name = "linkinpurry";
    private $username = "user";
    private $password = "secret";
    private $conn;

    private static $instance = null;

    private function __construct() {
        $this->conn = null;
        try {
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    private function __clone() {}

    public function __wakeup() {}

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database(); 
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>