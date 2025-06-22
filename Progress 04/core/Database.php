<?php
class Database {
    private $host = 'localhost';
    private $db = 'ticktask';
    private $user = 'root';
    private $pass = 'root';
    public $pdo;

    public function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->db";
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("DB connection failed: " . $e->getMessage());
        }
    }
}
