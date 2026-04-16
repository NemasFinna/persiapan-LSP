<?php
require_once "Database.php";

class Jabatan extends Database {

    public function getAllJabatan() {
        $sql = "SELECT * FROM tb_jabatan";
        return $this->conn->query($sql);
    }
}

?>