<?php
require 'Database.php';

class Pegawai extends Database {
    private $id;
    private $nama;
    private $jabatan;
    private $departemen;
    private $gaji;
    private $alamat;

    public function getAllPegawai() {
        $sql = "SELECT tb_pegawai.id_pegawai, tb_pegawai.nama, tb_jabatan.nama_jabatan, tb_departemen.nama_departemen, 
        tb_pegawai.gaji, tb_pegawai.alamat FROM tb_pegawai JOIN tb_jabatan ON tb_pegawai.jabatan_id = 
        tb_jabatan.id_jabatan JOIN tb_departemen ON tb_pegawai.departemen_id = tb_departemen.id_departemen";
        $result = $this->conn->query($sql);

        return $result;
    }

    public function getPegawaiById($id) {
        $this->id = $id;
        $sql = "SELECT * FROM tb_pegawai WHERE id_pegawai = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_assoc();
    }

    public function insertPegawai($nama, $jabatan_id, $departemen_id, $gaji, $alamat) {
        $this->nama = $nama;
        $this->jabatan = $jabatan_id;
        $this->departemen = $departemen_id;
        $this->gaji = $gaji;
        $this->alamat = $alamat;

        $sql = "INSERT INTO tb_pegawai (nama, jabatan_id, departemen_id, gaji, alamat) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siids", $this->nama, $this->jabatan, $this->departemen, $this->gaji, $this->alamat);
        
        return $stmt->execute();
    }

    public function updatePegawai($id, $nama, $jabatan_id, $departemen_id, $gaji, $alamat) {
        $sql = "UPDATE tb_pegawai SET nama = ?, jabatan_id = ?, departemen_id = ?, gaji = ?, 
        alamat = ? WHERE id_pegawai = ?";
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bind_param("siidsi", $nama, $jabatan_id, $departemen_id, $gaji, $alamat, $id);
        return $stmt->execute();
    }

    public function deletePegawai($id) {
        $sql = "DELETE FROM tb_pegawai WHERE id_pegawai = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function searchPegawai($keyword) {
        $sql = "SELECT tb_pegawai.id_pegawai, tb_pegawai.nama, tb_jabatan.nama_jabatan, tb_departemen.nama_departemen, 
        tb_pegawai.gaji, tb_pegawai.alamat FROM tb_pegawai JOIN tb_jabatan ON tb_pegawai.jabatan_id = tb_jabatan.id_jabatan 
        JOIN tb_departemen ON tb_pegawai.departemen_id = tb_departemen.id_departemen WHERE tb_pegawai.nama LIKE ? 
        OR tb_departemen.nama_departemen LIKE ?";
        $stmt = $this->conn->prepare($sql);
        
        $like = "%".$keyword."%";
        $stmt->bind_param("ss", $like, $like);
        $stmt->execute();

        return $stmt->get_result();
    }
}

?>