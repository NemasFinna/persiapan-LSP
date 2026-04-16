<?php

$id = $_GET['id'];

$dataOrder = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM orders_table WHERE order_id = '$id'"));

$dataMenusTable = mysqli_query($connect, "SELECT * FROM menus_table");
$dataCustomersTable = mysqli_query($connect, "SELECT * FROM customers_table");
$dataUsersTable = mysqli_query($connect, "SELECT * FROM users_table");

if (isset($_POST['editOrder'])) {
    $menu_id = $_POST['menu_id'];
    $customer_id = $_POST['customer_id'];
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];

    $dataEditOrder = mysqli_query($connect, "UPDATE orders_table SET
    menu_id = '$menu_id',
    customer_id = '$customer_id',
    user_id = '$user_id',
    amount = '$amount'
    WHERE order_id = '$id'");

    if ($dataEditOrder) {
        echo "<script>
       alert('data berhasil dikirim');
       window.location.href = 'index.php?page=ordersView&action=view';
       </script>";
    } else {
        echo mysqli_error($connect);
    }
}

?>

<div class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <form method="POST" class="p-4 bg-white shadow rounded" style="width: 400px;">
        <h4 class="text-center mb-3">Edit Order</h4>

        <div class="mb-3">
            <label class="form-label">Menu</label>
            <select name="menu_id" class="form-select">
                <?php while ($menu = $dataMenusTable -> fetch_assoc()): ?>
                    <option value="<?= $menu['menu_id'] ?>" <?= $dataOrder['menu_id'] == $menu['menu_id'] ? 'selected' : '' ?>>
                        <?= $menu['menu_id'] ?> - <?= $menu['menu_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" class="form-select">
                <?php while ($customer = $dataCustomersTable -> fetch_assoc()): ?>
                    <option value="<?= $customer['customer_id'] ?>" <?= $dataOrder['customer_id'] == $customer['customer_id'] ? 'selected' : '' ?>>
                        <?= $customer['customer_id'] ?> - <?= $customer['customer_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">User</label>
            <select name="user_id" class="form-select">
                <?php while ($user = $dataUsersTable -> fetch_assoc()): ?>
                    <option value="<?= $user['user_id'] ?>" <?= $dataOrder['user_id'] == $user['user_id'] ? 'selected' : '' ?>>
                        <?= $user['user_id'] ?> - <?= $user['full_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="number" name="amount" value="<?= $dataOrder['amount'] ?>" class="form-control" required>
        </div>

        <button name="editOrder" class="btn btn-warning w-100">Update Order</button>
    </form>

</div>