<?php
require_once __DIR__ . '/../config/connect_db.php';

class Pengguna extends KoneksiDB {
    private $query;
    private $result;
    
    public function findAll() {
        $this->query = "SELECT * FROM akun";
        $this->result = $this->conn->prepare($this->query);
        $this->result->execute();
        return $this->result->fetchAll();
    }

    // public function findById($id) {
    //     $this->query = "SELECT * FROM akun WHERE id_pengguna = ?";
    //     $this->result = $this->conn->prepare($this->query);
    //     $this->result->execute([$id]);
    //     return $this->result->fetch();
    // }
    
    public function updatePengguna($id, $namaPengguna, $email, $username) {
        $this->query = "UPDATE akun SET nama_pengguna = ?, email = ?, username = ? WHERE id_pengguna = ?";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$namaPengguna, $email, $username, $id]);
    }

    public function updatePassword($username, $passwordBaru) {
        $this->query = "UPDATE akun SET password = ? WHERE username = ?";
        $this->result = $this->conn->prepare($this->query);
        return $this->result->execute([$passwordBaru, $username]);
    }
}