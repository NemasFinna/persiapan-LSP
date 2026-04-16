<?php
$order_id = $_POST['order_id'] ?? 1;
$final_price = 0;

$joinedTable = mysqli_fetch_assoc(mysqli_query($connect, "
    SELECT menus_table.price, orders_table.amount 
    FROM orders_table 
    JOIN menus_table 
    ON orders_table.menu_id = menus_table.menu_id 
    WHERE orders_table.order_id = '$order_id'
"));

$dataOrder = mysqli_query($connect, "
    SELECT orders_table.*, menus_table.menu_name 
    FROM orders_table 
    JOIN menus_table ON orders_table.menu_id = menus_table.menu_id
");

$final_price = $joinedTable['price'] * $joinedTable['amount'];

// Saat submit
if (isset($_POST['addTransaction'])) {
    $order_id = $_POST['order_id'];
    $payment = $_POST['payment'];

    $dataAddTransaction = mysqli_query($connect, "
        INSERT INTO transactions_table (order_id, final_price, payment) 
        VALUES ('$order_id','$final_price','$payment')
    ");

    if ($dataAddTransaction) {
        echo "<script>
        window.location.href = 'index.php?page=transactionsView&action=view';
        alert('data berhasil dikirim');</script>";
    } else {
        echo mysqli_error($connect);
    }
}
?>

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <form method="POST" class="border p-4 rounded" style="width: 400px;">

        <h4 class="text-center mb-3">Add Transaction</h4>

        <div class="mb-3">
            <label>Order</label>
            <select name="order_id" onchange="this.form.submit()" class="form-control">
                <?php while ($order = $dataOrder->fetch_assoc()): ?>
                    <option value="<?= $order['order_id'] ?>" <?= ($order_id == $order['order_id']) ? 'selected' : '' ?>>
                        <?= $order['order_id'] ?> - <?= $order['amount'] ?>X <?= $order['menu_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Final Price</label>
            <input type="number" value="<?= $final_price ?>" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label>Payment</label>
            <input type="number" name="payment" class="form-control" required>
        </div>

        <button name="addTransaction" class="btn btn-primary w-100">Submit</button>

    </form>
</div>