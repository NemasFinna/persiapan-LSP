<?php
    require 'config/Pegawai.php';

    $pegawai = new Pegawai();
    if (isset($_GET['search'])) {
        $result = $pegawai->searchPegawai($_GET['search']);
    } else {
        $result = $pegawai->getAllPegawai();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai</title>
</head>
<body>
    <h2>Daftar Pegawai Kantor</h2>
    <a href="tambah.php">Tambah Pegawai</a>
    <br><br>

    <form method="get">
        <input type="text" name="search" placeholder="Cari nama atau departemen">
        <button type="submit">Cari</button>
    </form>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Departemen</th>
            <th>Gaji</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) : ?>

        <tr>
            <td><?= $row['id_pegawai']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nama_jabatan']; ?></td>
            <td><?= $row['nama_departemen']; ?></td>
            <td><?= 'Rp. '. number_format($row['gaji'], 0, ',', '.') ?></td>
            <td><?= $row['alamat']; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_pegawai']; ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row['id_pegawai']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>

        <?php endwhile; ?>
    </table>
</body>
</html>