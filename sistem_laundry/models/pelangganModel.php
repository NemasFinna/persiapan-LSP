<?php
require_once __DIR__ . '/../config/connect_db.php';

class Pelanggan extends KoneksiDB {
    private $query;
    private $result;
    
    public function findAll() {
        $this->query = "SELECT * FROM pelanggan";
        $this->result = $this->conn->prepare($this->query);
        $this->result->execute();
        return $this->result->fetchAll();
    }

    // public function findById($id) {
    //     $this->query = "SELECT * FROM pelanggan WHERE id_pelanggan = ?";
    //     $this->result = $this->conn->prepare($this->query);
    //     $this->result->execute([$id]);
    //     return $this->result->fetch();
    // }
        
    public function insertData($namaPelanggan, $noTelp, $alamat) {
        $this->query = "INSERT INTO pelanggan (nama, no_hp, alamat) VALUES (?, ?, ?)";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$namaPelanggan, $noTelp, $alamat]);
    }
    
    public function updateData($id, $namaPelanggan, $noTelp, $alamat) {
        $this->query = "UPDATE pelanggan SET nama = ?, no_hp = ?, alamat = ? WHERE id_pelanggan = ?";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$namaPelanggan, $noTelp, $alamat, $id]);
    }

    public function deleteData($id) {
        $this->query = "DELETE FROM pelanggan WHERE id_pelanggan = ?";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$id]);
    }
}