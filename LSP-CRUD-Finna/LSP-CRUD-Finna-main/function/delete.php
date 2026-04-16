<?php
include('connect.php');
$table_name = $_GET['table_name'];
$table_column = $_GET['table_column'];
$table_id = $_GET['table_id'];

mysqli_query($connect,"DELETE FROM $table_name WHERE $table_column = $table_id");

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;

?>