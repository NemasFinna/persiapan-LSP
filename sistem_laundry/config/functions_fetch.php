<?php

require 'models/pelangganModel.php';
require 'models/layananModel.php';
require 'models/transaksiModel.php';
require 'models/penggunaModel.php';
require 'models/logaktivitasModel.php';

function get_pelanggan() {
    $pelanggan = new Pelanggan;
    $getPelanggan = $pelanggan->findAll();
    return $getPelanggan;
}

function get_layanan() {
    $layanan = new Layanan;
    $getLayanan = $layanan->findAll();
    return $getLayanan;
}

function get_transaksi() {
    $transaksi = new Transaksi;
    $getTransaksi = $transaksi->findAll();
    return $getTransaksi;
}

function get_pengguna() {
    $pengguna = new Pengguna;
    $getPengguna = $pengguna->findAll();
    return $getPengguna;
}

function get_log() {
    $log = new Log;
    $getLog = $log->findAll();
    return $getLog;
}

function time_ago($timestamp) {
    // Ubah string timestamp menjadi objek DateTime
    $datetime = new DateTime($timestamp);
    $now = new DateTime(); // Waktu saat ini

    // Hitung perbedaan waktu
    $interval = $now->diff($datetime);

    // Tentukan apakah waktu itu di masa lalu atau masa depan
    if ($interval->invert == 0) {
        return "Di masa depan";
    }

    // Cek perbedaan waktu dan kembalikan format yang sesuai
    if ($interval->y >= 1) {
        return $interval->y . ' tahun yang lalu';
    } else if ($interval->m >= 1) {
        return $interval->m . ' bulan yang lalu';
    } else if ($interval->d >= 1) {
        return $interval->d . ' hari yang lalu';
    } else if ($interval->h >= 1) {
        return $interval->h . ' jam yang lalu';
    } else if ($interval->i >= 1) {
        return $interval->i . ' menit yang lalu';
    } else {
        return 'Baru saja';
    }
}

function formatRupiah($angka) {
    return 'Rp. '. number_format($angka, 0, ',', '.');
}
