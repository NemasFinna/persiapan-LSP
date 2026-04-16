<?php 
session_start();
require '../models/layananModel.php';
require '../models/logaktivitasModel.php';

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'tambah_layanan') {
        $namaLayanan = htmlspecialchars($_POST['nama_layanan']);
        $hargaPerKg = htmlspecialchars($_POST['harga']);

        $layanan = new Layanan;
        $layanan->insertData($namaLayanan, $hargaPerKg);

        $log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' menambahkan data layanan';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        $_SESSION['pesan'] = 'Data layanan berhasil tersimpan!';
        $_SESSION['status'] = 'success'; 
        header("Location: ../index.php?page=layanan");
        exit;
    } 
    else if ($_GET['proses'] == 'ubah_layanan') {
        $id = $_POST['id'];
        $namaLayanan = htmlspecialchars($_POST['nama_layanan']);
        $hargaPerKg = htmlspecialchars($_POST['harga']);

        $layanan = new Layanan;
        $layanan->updateData($id, $namaLayanan, $hargaPerKg);

        $log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' merubah data layanan';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        $_SESSION['pesan'] = 'Data layanan berhasil terubah!';
        $_SESSION['status'] = 'success'; 
        header("Location: ../index.php?page=layanan");
        exit;
    }
    else if ($_GET['proses'] == 'hapus_layanan') {
        $id = $_GET['id'];
        $layanan = new Layanan;
        $layanan->deleteData($id);

        $log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' menghapus data layanan';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        $_SESSION['pesan'] = 'Data layanan berhasil terhapus!';
        $_SESSION['status'] = 'success'; 
        header("Location: ../index.php?page=layanan");
        exit;
    }
}