<?php 

class KoneksiDB {
    private $server;
    private $username;
    private $password;
    private $database;
    public $conn;
    
    public function __construct() {
        $this->server = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = 'sistemlaundry';

        try {   
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Koneksi database berhasil!";
        } catch (PDOException $e) {
            echo "Koneksi database gagal: " . $e->getMessage();
        }
    }
    
}