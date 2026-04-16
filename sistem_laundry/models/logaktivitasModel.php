<?php
require_once __DIR__ . '/../config/connect_db.php';

class Log extends KoneksiDB {
    private $query;
    private $result;
    
    public function findAll() {
        $this->query = "SELECT * FROM log_aktivitas ORDER BY waktu DESC LIMIT 8";
        $this->result = $this->conn->prepare($this->query);
        $this->result->execute();
        return $this->result->fetchAll();
    }

    // public function findById($id) {
    //     $this->query = "SELECT * FROM log_aktivitas WHERE id_log = ?";
    //     $this->result = $this->conn->prepare($this->query);
    //     $this->result->execute([$id]);
    //     return $this->result->fetch();
    // }
        
    public function insertData($id, $aktivitas, $tanggal) {
        $this->query = "INSERT INTO log_aktivitas (id_pengguna, aktivitas, waktu) VALUES (?, ?, ?)";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$id, $aktivitas, $tanggal]);
    }

    public function resetLog() {
        $this->query = "TRUNCATE TABLE log_aktivitas";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute();
    }
}