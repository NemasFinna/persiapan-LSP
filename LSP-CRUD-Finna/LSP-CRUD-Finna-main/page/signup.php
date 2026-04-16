<?php
require("../function/connect.php");
session_start();

if(isset($_POST['signup'])){
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $dataSignUp = mysqli_query($connect,"INSERT INTO users_table (full_name,username,password,role) VALUES ('$full_name','$username','$password','$role')");

    if($dataSignUp){
       echo "<script>
       window.location.href = 'login.php';
       alert('data berhasil dikirim');
       </script>" ;
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

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <form method="POST" class="p-4 bg-white shadow rounded" style="width: 350px;">
        <h4 class="text-center mb-3">Sign Up</h4>

        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-select">
                <option value="Administrator">Administrator</option>
                <option value="Waiter">Waiter</option>
                <option value="Cashier">Cashier</option>
                <option value="Owner">Owner</option>
                <option value="Manager">Manager</option>
            </select>
        </div>

        <button name="signup" class="btn btn-success w-100">Sign Up</button>

        <div class="text-center mt-3">
            <a href="login.php">Already have an account? Login</a>
        </div>
    </form>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>