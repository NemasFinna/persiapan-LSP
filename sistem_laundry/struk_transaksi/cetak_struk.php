<?php  
    require_once '../config/connect_db.php';
    require '../models/transaksiModel.php';

    $id = $_GET['id'];
    $transaksi = new Transaksi();
    $data = $transaksi->findById($id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Laundry - Struk Transaksi <?= $data['nama']; ?></title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            margin: 0;
            padding: 20px;
            background: #fff;
        }
        .struk {
            max-width: 350px;
            margin: auto;
            border: 1px dashed #000;
            padding: 10px;
        }
        .struk h2, .struk h3 {
            text-align: center;
            margin: 0;
            text-transform: uppercase;
        }
        .struk p {
            text-transform: uppercase;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .info, .detail {
            width: 100%;
        }
        .info td, .detail td {
            padding: 4px 0;
        }
        .right {
            text-align: right;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="struk">
        <h2>SI Laundry</h2>
        <h3>Struk Transaksi</h3>
        <div class="line"></div>
        <table class="info">
            <tr>
                <td>ID Transaksi</td>
                <td class="right"><?= $data['id_transaksi']; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td class="right"><?= date('d-m-Y', strtotime($data['tanggal'])); ?></td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td class="right"><?= $data['nama']; ?></td>
            </tr>
        </table>
        <div class="line"></div>
        <table class="detail">
            <tr>
                <td>Layanan</td>
                <td class="right"><?= $data['nama_layanan']; ?></td>
            </tr>
            <tr>
                <td>Berat</td>
                <td class="right"><?= $data['berat']; ?> Kg</td>
            </tr>
            <tr>
                <td>Harga/Kg</td>
                <td class="right">Rp <?= number_format($data['harga_per_kg'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td class="right">Rp <?= number_format($data['total_harga'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td class="right"><?= $data['status']; ?></td>
            </tr>
        </table>
        <div class="line"></div>
        <p class="center">Terima kasih <br> telah menggunakan layanan kami!</p>
        <p class="center">~ SI Laundry ~</p>
    </div>
</body>
</html>
