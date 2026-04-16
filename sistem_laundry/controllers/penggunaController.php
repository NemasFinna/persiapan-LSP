<?php 
session_start();
require '../models/penggunaModel.php';
require '../models/logaktivitasModel.php';
require_once __DIR__ . '/../config/connect_db.php';

$koneksi = new KoneksiDB();
$database = $koneksi->conn;

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'ubah_pengguna') {
        $id = $_POST['id'];
        $namaPengguna = htmlspecialchars($_POST['nama_pengguna']);
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);

        $pengguna = new Pengguna;
        $pengguna->updatePengguna($id, $namaPengguna, $email, $username);

        // mengganti data nama admin atau pengguna yang baru dirubah
        $sql = "SELECT * FROM akun WHERE id_pengguna = '$id'";
        $query = $database->prepare($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        $log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' merubah data pengguna';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        $_SESSION['pesan'] = 'Data pengguna berhasil terubah!';
        $_SESSION['status'] = 'success'; 
        $_SESSION['admin'] = $data['nama_pengguna'];
        header("Location: ../index.php?page=pengguna");
        exit;
    } 
    else if ($_GET['proses'] == 'ubah_password') {
        $username = htmlspecialchars($_POST['username']);
        $passwordLama = htmlspecialchars($_POST['password_lama']);
        $passwordBaru = htmlspecialchars($_POST['password_baru']);

        $sql = "SELECT * FROM akun WHERE username = '$username'";
        $query = $database->prepare($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $baris = $query->rowCount(); 

        if ($baris > 0) {
            $passwordLama = password_verify($passwordLama, $data['password']);

            if ($passwordLama) {
                $pengguna = new Pengguna;
                $passwordBaruHash = password_hash($passwordBaru, PASSWORD_DEFAULT);
                $pengguna->updatePassword($username, $passwordBaruHash);

                $log = new Log;
                $id = $_SESSION['id'];
                $aktivitas = $_SESSION['admin'] . ' merubah password';
                $tanggal = date('Y-m-d H:i:s');
                $log->insertData($id, $aktivitas, $tanggal);

                $_SESSION['pesan'] = 'Password berhasil terubah!';
                $_SESSION['status'] = 'success'; 
                header("Location: ../index.php?page=pengguna");
                exit;
            } else {
                $_SESSION['pesan'] = 'Password lama anda tidak valid!';
                $_SESSION['status'] = 'warning'; 
                header("Location: ../index.php?page=pengguna");
                exit;
            }
        } else {
            $_SESSION['pesan'] = 'Username anda tidak valid!';
            $_SESSION['status'] = 'warning'; 
            header("Location: ../index.php?page=pengguna");
            exit;
        }
    }   
    else if ($_GET['proses'] == 'reset_log') {
        $log = new Log;
        $log->resetLog();

        $_SESSION['pesan'] = 'Riwayat log sistem berhasil terhapus!';
        $_SESSION['status'] = 'success'; 
        header("Location: ../index.php?page=log_aktivitas");
        exit;
    } 
    else if ($_GET['proses'] == 'logout') {
        $log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' keluar dari sistem dashboard';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        session_unset();
        session_destroy();

        setcookie('ID', '', time() - 3600, '/');
        setcookie('KEY', '', time() - 3600, '/');

        header('Location: ../login.php');
        exit;
    }
}