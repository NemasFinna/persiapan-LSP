<?php
$id = $_GET['id'];
$dataTransaction = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM transactions_table WHERE transaction_id = '$id'"));

$order_id = $_POST['order_id'] ?? 1;
$final_price = 0;

$calculateFinalPrice = mysqli_fetch_assoc(mysqli_query($connect, "
    SELECT menus_table.price, orders_table.amount 
    FROM orders_table 
    JOIN menus_table 
    ON orders_table.menu_id = menus_table.menu_id 
    WHERE orders_table.order_id = '$order_id'
"));

$dataOrder = mysqli_query($connect, "
    SELECT orders_table.*, menus_table.menu_name 
    FROM orders_table 
    JOIN menus_table ON orders_table.order_id = menus_table.menu_id
");

$final_price = $calculateFinalPrice['price'] * $calculateFinalPrice['amount'];

// Saat submit
if (isset($_POST['editTransaction'])) {
    $order_id = $_POST['order_id'];
    $payment = $_POST['payment'];

    $dataEditTransaction = mysqli_query($connect, "UPDATE transactions_table SET
    order_id = '$order_id',
    payment = '$payment',
    final_price = '$final_price'
    WHERE transaction_id = '$id'");

    if ($dataEditTransaction) {
        echo "<script>
        alert('data berhasil dikirim');
        window.location.href = 'index.php?page=transactionView&action=view';
        </script>";
    } else {
        echo mysqli_error($connect);
    }
}
?>

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <form method="POST" class="border p-4 rounded" style="width: 400px;">

        <h4 class="text-center mb-3">Edit Transaction</h4>

        <div class="mb-3">
            <label>Order</label>
            <select name="order_id" onchange="this.form.submit()" class="form-control">
                <?php $selectedOrder = $_POST['order_id'] ?? $dataTransaction['order_id']; while ($order = $dataOrder->fetch_assoc()): ?>
                    <option value="<?= $order['order_id'] ?>" <?= ($selectedOrder == $order['order_id']) ? 'selected' : '' ?>>
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
            <input type="number" name="payment" value="<?= $dataTransaction['payment'] ?>" class="form-control">
        </div>

        <button name="editTransaction" class="btn btn-warning w-100">Update Transaction</button>

    </form>
</div>