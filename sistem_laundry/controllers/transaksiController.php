<?php 
session_start();
require '../models/transaksiModel.php';
require '../models/layananModel.php';
require '../models/logaktivitasModel.php';

function get_layanan() {
    $layanan = new Layanan;
    $getLayanan = $layanan->findAll();
    return $getLayanan;
}

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'tambah_transaksi') {
        $namaPelanggan = htmlspecialchars($_POST['pelanggan']);
        $layanan = htmlspecialchars($_POST['layanan']);
        $berat = htmlspecialchars($_POST['berat']);
        $tanggal = htmlspecialchars($_POST['tanggal']);
        $status = htmlspecialchars($_POST['status']);

        // hitung jumlah total per kg dan berat
        $dataLayanan = get_layanan();
        foreach ($dataLayanan as $data) {
            if ($data['id_layanan'] == $layanan) {
                $totalHarga = $data['harga_per_kg'] * $berat; 
            }
        }

        $pelanggan = new Transaksi;
        $pelanggan->insertData($namaPelanggan, $layanan, $berat, $totalHarga, $tanggal, $status);

        $log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' menambahkan data transaksi';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        $_SESSION['pesan'] = 'Data transaksi berhasil tersimpan!';
        $_SESSION['status'] = 'success'; 
        header("Location: ../index.php?page=transaksi");
        exit;
    } 
    else if ($_GET['proses'] == 'ubah_transaksi') {
        $id = $_POST['id'];
        $namaPelanggan = htmlspecialchars($_POST['pelanggan']);
        $layanan = htmlspecialchars($_POST['layanan']);
        $berat = htmlspecialchars($_POST['berat']);
        $tanggal = htmlspecialchars($_POST['tanggal']);
        $status = htmlspecialchars($_POST['status']);

        // hitung jumlah total per kg dan berat
        $dataLayanan = get_layanan();
        foreach ($dataLayanan as $data) {
            if ($data['id_layanan'] == $layanan) {
                $totalHarga = $data['harga_per_kg'] * $berat; 
            }
        }

        $pelanggan = new Transaksi;
        $pelanggan->updateData($id, $namaPelanggan, $layanan, $berat, $totalHarga, $tanggal, $status);

        $log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' merubah data transaksi';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        $_SESSION['pesan'] = 'Data transaksi berhasil terubah!';
        $_SESSION['status'] = 'success'; 
        header("Location: ../index.php?page=transaksi");
        exit;
    }
    else if ($_GET['proses'] == 'hapus_transaksi') {
        $id = $_GET['id'];
        $pelanggan = new Transaksi;
        $pelanggan->deleteData($id);

        $log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' menghapus data transaksi';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        $_SESSION['pesan'] = 'Data transaksi berhasil terhapus!';
        $_SESSION['status'] = 'success'; 
        header("Location: ../index.php?page=transaksi");
        exit;
    }
}