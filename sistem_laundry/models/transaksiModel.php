<?php
require_once __DIR__ . '/../config/connect_db.php';

class Transaksi extends KoneksiDB {
    private $query;
    private $result;
    
    public function findAll() {
        $this->query = "SELECT transaksi.id_transaksi, transaksi.id_pelanggan, pelanggan.nama, transaksi.id_layanan, 
        layanan.nama_layanan, transaksi.berat, transaksi.total_harga, transaksi.tanggal, transaksi.status FROM transaksi 
        INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN layanan ON 
        transaksi.id_layanan = layanan.id_layanan ORDER BY pelanggan.nama ASC";
        
        $this->result = $this->conn->prepare($this->query);
        $this->result->execute();
        return $this->result->fetchAll();
    }

    public function findById($id) {
        $this->query = "SELECT transaksi.id_transaksi, transaksi.id_pelanggan, pelanggan.nama, transaksi.id_layanan, 
        layanan.nama_layanan, layanan.harga_per_kg, transaksi.berat, transaksi.total_harga, transaksi.tanggal, transaksi.status FROM transaksi 
        INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN layanan ON 
        transaksi.id_layanan = layanan.id_layanan WHERE transaksi.id_transaksi = ?";

        $this->result = $this->conn->prepare($this->query);
        $this->result->execute([$id]);
        return $this->result->fetch();
    }
    
    public function insertData($namaPelanggan, $layanan, $berat, $totalHarga, $tanggal, $status) {
        $this->query = "INSERT INTO transaksi (id_pelanggan, id_layanan, berat, total_harga, tanggal, status) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$namaPelanggan, $layanan, $berat, $totalHarga, $tanggal, $status]);
    }
    
    public function updateData($id, $namaPelanggan, $layanan, $berat, $totalHarga, $tanggal, $status) {
        $this->query = "UPDATE transaksi SET id_pelanggan = ?, id_layanan = ?, berat = ?, total_harga = ?, tanggal = ?, 
        status = ? WHERE id_transaksi = ?";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$namaPelanggan, $layanan, $berat, $totalHarga, $tanggal, $status, $id]);
    }

    public function deleteData($id) {
        $this->query = "DELETE FROM transaksi WHERE id_transaksi = ?";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$id]);
    }
}