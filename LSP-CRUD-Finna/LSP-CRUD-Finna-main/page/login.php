<?php
require("../function/connect.php");
session_start();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $dataLogin = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users_table WHERE username = '$username'"));

    if($dataLogin && $password === $dataLogin['password']){
        $_SESSION["user_id"] = $dataLogin['user_id'];
        $_SESSION["full_name"] = $dataLogin['full_name'];
        $_SESSION["username"] = $dataLogin['username'];
        $_SESSION["password"] = $dataLogin['password'];
        $_SESSION["role"] = $dataLogin['role'];

        echo "<script>
        window.location.href = 'index.php';
        alert('login berhasil');
        </script>";
    } else {
        echo mysqli_error($connect);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light" >

    <form method="POST" class="p-4 bg-white shadow rounded" style="width: 300px;">
        <h4 class="text-center mb-3">Login</h4>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="text" name="password" class="form-control">
        </div>

        <button name="login" class="btn btn-primary w-100">Login</button>

        <div class="text-center mt-3">
            <a href="signup.php">Sign Up</a>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>