<?php
	require 'config/Pegawai.php';
	$pegawai = new Pegawai();

	$id = $_GET['id'];
	$pegawai->deletePegawai($id);
	header("Location: index.php");
?>