<?php  
session_start();
require_once __DIR__ . '/../config/connect_db.php';
require '../models/logaktivitasModel.php';

$koneksi = new KoneksiDB();
$database = $koneksi->conn;

// remember me
if (isset($_COOKIE['ID']) && isset($_COOKIE['KEY'])) {
	$idCookie = $_COOKIE['ID'];
	$sql = "SELECT * FROM akun WHERE id_pengguna = '$idCookie'";
	$query = $database->prepare($sql);
	$query->execute();
	$res = $query->fetch(PDO::FETCH_ASSOC);

	if ($_COOKIE['KEY'] == hash('sha256', $res['username'])) {
		$_SESSION['logged_in'] = true;
	}
}

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$sql = "SELECT * FROM akun WHERE username = :username";
$query = $database->prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();

$data = $query->fetch(PDO::FETCH_ASSOC);
$baris = $query->rowCount();

if ($baris > 0) {
	$passwordCheck = password_verify($password, $data['password']);
	if ($passwordCheck) {
		$_SESSION['id'] = $data['id_pengguna'];
		$_SESSION['admin'] = $data['nama_pengguna'];
		$_SESSION['logged_in'] = true;

		$log = new Log;
        $id = $_SESSION['id'];
        $aktivitas = $_SESSION['admin'] . ' login ke dalam sistem dashboard';
        $tanggal = date('Y-m-d H:i:s');
        $log->insertData($id, $aktivitas, $tanggal);

        // remember me 
        if ($_POST['remember']) {
        	setcookie('ID', $data['id_pengguna'], time() + 60, '/');
        	setcookie('KEY', hash('sha256', $data['username']), time() + 60, '/');
        }

		header('Location: ../index.php?page=dashboard');
		exit;
	} else {
		$_SESSION['pesan'] = 'Password anda tidak valid!';
        $_SESSION['status'] = 'danger'; 
		header('Location: ../login.php');
		exit;
	}
} else {
	$_SESSION['pesan'] = 'Username anda tidak valid!';
    $_SESSION['status'] = 'danger'; 
	header('Location: ../login.php');
	exit;
}