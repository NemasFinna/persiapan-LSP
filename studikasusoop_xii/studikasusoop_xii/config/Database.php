<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_perusahaan";
    protected $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}

?>