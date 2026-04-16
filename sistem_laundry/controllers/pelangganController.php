<?php 
session_start();
require '../models/pelangganModel.php';
require '../models/logaktivitasModel.php';

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'tambah_pelanggan') {
        $namaPelanggan = htmlspecialchars($_POST['nama_pelanggan']);
        $noTelp = htmlspecialchars($_POST['no_telp']);
        $alamat = htmlspecialchars($_POST['alamat']);

        $pelanggan = new Pelanggan;
        $pelanggan->insertData($namaPelanggan, $noTelp, $alamat);

        $log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' menambahkan data pelanggan';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        $_SESSION['pesan'] = 'Data pelanggan berhasil tersimpan!';
        $_SESSION['status'] = 'success'; 
        header("Location: ../index.php?page=pelanggan");
        exit;
    } 
    else if ($_GET['proses'] == 'ubah_pelanggan') {
        $id = $_POST['id'];
        $namaPelanggan = htmlspecialchars($_POST['nama_pelanggan']);
        $noTelp = htmlspecialchars($_POST['no_telp']);
        $alamat = htmlspecialchars($_POST['alamat']);

        $pelanggan = new Pelanggan;
        $pelanggan->updateData($id, $namaPelanggan, $noTelp, $alamat);

        $log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' merubah data pelanggan';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        $_SESSION['pesan'] = 'Data pelanggan berhasil terubah!';
        $_SESSION['status'] = 'success'; 
        header("Location: ../index.php?page=pelanggan");
        exit;
    }
    else if ($_GET['proses'] == 'hapus_pelanggan') {
        $id = $_GET['id'];
        $pelanggan = new Pelanggan;
        $pelanggan->deleteData($id);

        $log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' menghapus data pelanggan';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        $_SESSION['pesan'] = 'Data pelanggan berhasil terhapus!';
        $_SESSION['status'] = 'success'; 
        header("Location: ../index.php?page=pelanggan");
        exit;
    }
}