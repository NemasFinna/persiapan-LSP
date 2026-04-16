<?php
require_once "Database.php";

class Departemen extends Database
{

    public function getAllDepartemen()
    {
        $sql = "SELECT * FROM tb_departemen";
        return $this->conn->query($sql);
    }
}

?>