<?php

$dataMenusTable = mysqli_query($connect, "SELECT * FROM menus_table");
$dataCustomersTable = mysqli_query($connect, "SELECT * FROM customers_table");
$dataUsersTable = mysqli_query($connect, "SELECT * FROM users_table");

if (isset($_POST['addOrder'])) {
    $menu_id = $_POST['menu_id'];
    $customer_id = $_POST['customer_id'];
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];

    $dataAddOrder = mysqli_query($connect, "INSERT INTO orders_table (menu_id,customer_id,user_id,amount) VALUES ('$menu_id','$customer_id','$user_id','$amount')");

    if ($dataAddOrder) {
        echo "<script>
        window.location.href = 'index.php?page=ordersView&action=view';
       alert('data berhasil dikirim');
       </script>";
    } else {
        echo mysqli_error($connect);
    }
}

?>

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <form method="POST" class="border p-4 rounded" style="width: 400px;">

        <h4 class="text-center mb-3">Add Order</h4>

        <div class="mb-3">
            <label>Menu</label>
            <select name="menu_id" class="form-control">
                <?php while ($menu = $dataMenusTable->fetch_assoc()): ?>
                    <option value="<?= $menu['menu_id'] ?>">
                        <?= $menu['menu_id'] ?> - <?= $menu['menu_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Customer</label>
            <select name="customer_id" class="form-control">
                <?php while ($customer = $dataCustomersTable->fetch_assoc()): ?>
                    <option value="<?= $customer['customer_id'] ?>">
                        <?= $customer['customer_id'] ?> - <?= $customer['customer_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                <?php while ($user = $dataUsersTable->fetch_assoc()): ?>
                    <option value="<?= $user['user_id'] ?>">
                        <?= $user['user_id'] ?> - <?= $user['full_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Amount</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <button name="addOrder" class="btn btn-primary w-100">Submit</button>

    </form>
</div>