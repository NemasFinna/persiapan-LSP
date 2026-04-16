<?php
require_once __DIR__ . '/../config/connect_db.php';

class Layanan extends KoneksiDB {
    private $query;
    private $result;
    
    public function findAll() {
        $this->query = "SELECT * FROM layanan";
        $this->result = $this->conn->prepare($this->query);
        $this->result->execute();
        return $this->result->fetchAll();
    }

    // public function findById($id) {
    //     $this->query = "SELECT * FROM layanan WHERE id_layanan = ?";
    //     $this->result = $this->conn->prepare($this->query);
    //     $this->result->execute([$id]);
    //     return $this->result->fetch();
    // }
    
    public function insertData($namaLayanan, $hargaPerKg) {
        $this->query = "INSERT INTO layanan (nama_layanan, harga_per_kg) VALUES (?, ?)";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$namaLayanan, $hargaPerKg]);
    }
    
    public function updateData($id, $namaLayanan, $hargaPerKg) {
        $this->query = "UPDATE layanan SET nama_layanan = ?, harga_per_kg = ? WHERE id_layanan = ?";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$namaLayanan, $hargaPerKg, $id]);
    }

    public function deleteData($id) {
        $this->query = "DELETE FROM layanan WHERE id_layanan = ?";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$id]);
    }
}