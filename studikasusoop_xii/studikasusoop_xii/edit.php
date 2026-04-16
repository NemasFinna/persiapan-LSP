<?php
    require_once "config/Pegawai.php";
    require_once "config/Jabatan.php";
    require_once "config/Departemen.php";

    $pegawai = new Pegawai();
    $jabatan = new Jabatan();
    $departemen = new Departemen();

    $id = $_GET['id'];
    $dataPegawai = $pegawai->getPegawaiById($id);
    $dataJabatan = $jabatan->getAllJabatan();
    $dataDepartemen = $departemen->getAllDepartemen();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan_id'];
        $departemen = $_POST['departemen_id'];
        $gaji = $_POST['gaji'];
        $alamat = $_POST['alamat'];

        $pegawai->updatePegawai($id, $nama, $jabatan, $departemen, $gaji, $alamat);
        header("Location: index.php");
    }
?>

<style>
    .input-kolom {
        margin-bottom: 10px;
    }

    input, select, textarea {
        width: 20%;
        padding: 3px;
    }
</style>

<h2>Tambah Data Pegawai</h2>
<form method="post">
    <div class="input-kolom">
        <label for="">Nama</label><br>
        <input type="text" name="nama" value="<?= $dataPegawai['nama']; ?>"><br>
    </div>
    
    <div class="input-kolom">
        <label for="">Jabatan</label><br>
        <select name="jabatan_id">
        <?php while($data = $dataJabatan->fetch_assoc()) : ?>
            <option value="<?= $data['id_jabatan'] ?>" 
            <?= ($dataPegawai['jabatan_id'] == $data['id_jabatan']) ? 'selected' : ''; ?>>
                <?= $data['nama_jabatan'] ?>        
            </option>
        <?php endwhile; ?>
        </select>
        <br>
    </div>
   
    <div class="input-kolom"
        <label>Departemen</label><br>
        <select name="departemen_id">
            <?php while($data = $dataDepartemen->fetch_assoc()) : ?>
                <option value="<?= $data['id_departemen'] ?>"
                <?= ($dataPegawai['departemen_id'] == $data['id_departemen']) ? 'selected' : ''; ?>>
                    <?= $data['nama_departemen'] ?>   
                </option>
            <?php endwhile; ?>
        </select>
        <br>
    </div>
    
    <div class="input-kolom">
        <label for="">Gaji</label><br>
        <input type="text" name="gaji" value="<?= $dataPegawai['gaji']; ?>"><br>
    </div>
    
    <div class="input-kolom">
        <label for="">Alamat</label><br>
        <textarea name="alamat"><?= $dataPegawai['alamat']; ?></textarea><br>
    </div>
    <br>
    <a href="index.php"><button type="button">Kembali</button></a>
    <button type="submit">Simpan</button>
</form>