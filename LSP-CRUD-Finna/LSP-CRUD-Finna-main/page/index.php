<?php
require("../function/connect.php");
session_start();

// cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// role
$role = $_SESSION['role'];

// mapping akses
$roleAccess = [
    'usersView' => ['Manager'],
    'customersView' => ['Administrator', 'Manager'],
    'menusView' => ['Administrator', 'Waiter', 'Manager'],
    'ordersView' => ['Waiter', 'Manager'],
    'transactionsView' => ['Cashier', 'Manager'],
];

// ambil page
$page = $_GET['page'] ?? 'home';
$action = ($_GET['action'] ?? null) ? $_GET['action'] . '/' : null;

$file = (isset($action) ? $action . $page : $page) . ".php";

// query data
// $dataMenusTable = mysqli_query($connect, "SELECT * FROM menus_table");
// $dataCustomersTable = mysqli_query($connect, "SELECT * FROM customers_table");
// $dataOrdersTable = mysqli_query($connect, "SELECT * FROM orders_table");
// $dataTransactionsTable = mysqli_query($connect, "SELECT * FROM transactions_table");
// $dataUsersTable = mysqli_query($connect, "SELECT * FROM users_table");   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>
<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="bg-dark text-white p-3" style="width: 350px; min-height: 100vh;">
        <h4 class="text-center">Dashboard</h4>
        <hr>

        <h5>Name = <?= $_SESSION['full_name'] ?></h5>
        <h5><?= $_SESSION['role'] ?></h5>

        <hr>

        <ul class="nav flex-column">

            <?php if (in_array($role, ['Manager'])): ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="?page=usersView&action=view">Users</a>
                </li>
            <?php endif; ?>

            <?php if (in_array($role, ['Administrator', 'Manager'])): ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="?page=customersView&action=view">Customers</a>
                </li>
            <?php endif; ?>

            <?php if (in_array($role, ['Administrator', 'Waiter', 'Manager'])): ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="?page=menusView&action=view">Menus</a>
                </li>
            <?php endif; ?>

            <?php if (in_array($role, ['Waiter', 'Manager'])): ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="?page=ordersView&action=view">Orders</a>
                </li>
            <?php endif; ?>

            <?php if (in_array($role, ['Cashier', 'Manager'])): ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="?page=transactionsView&action=view">Transactions</a>
                </li>
            <?php endif; ?>

        </ul>

        <hr>

        <a href="?logout=true" class="btn btn-danger w-100"
           onclick="return confirm('Yakin logout?')">Logout</a>
    </div>


    <!-- CONTENT -->
    <div class="flex-grow-1 p-4">
        
        <!-- LOAD PAGE -->
        <?php
        if (isset($roleAccess[$page]) && !in_array($role, $roleAccess[$page])) {
            echo "<script>alert('Anda tidak punya akses!')</script>";
        } elseif (file_exists($file)) {
            include $file;
        } else {
            include $page . '.php';
        }
        ?>

    </div>

</div>
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>


</html>