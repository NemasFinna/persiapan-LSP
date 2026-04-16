<?php

$dataTransactionsTable = mysqli_query($connect, "
SELECT 
    transactions_table.*,
    menus_table.menu_name,
    customers_table.customer_name,
    users_table.full_name,
    orders_table.amount
FROM transactions_table

JOIN orders_table 
    ON transactions_table.order_id = orders_table.order_id

JOIN menus_table 
    ON orders_table.menu_id = menus_table.menu_id

JOIN customers_table 
    ON orders_table.customer_id = customers_table.customer_id

JOIN users_table 
    ON orders_table.user_id = users_table.user_id
");

if (!$dataTransactionsTable) {
    die(mysqli_error($connect));
}

?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Transactions</h3>
    <a href="?page=addTransaction&action=add" class="btn btn-primary">+ Add Transaction</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Transaction ID</th>
            <th>Order ID</th>
            <th>Menu Name</th>
            <th>Customer Name</th>
            <th>Cashier Name</th>
            <th>Final Price</th>
            <th>Payment</th>
            <th width="200">Control</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($transaction = $dataTransactionsTable->fetch_assoc()): ?>
            <tr>
                <td><?= $transaction['transaction_id'] ?></td>
                <td><?= $transaction['order_id'] ?></td>
                <td><?= $transaction['menu_name'] ?></td>
                <td><?= $transaction['customer_name'] ?></td>
                <td><?= $transaction['full_name'] ?></td>
                <td><?= $transaction['final_price'] ?></td>
                <td><?= $transaction['payment'] ?></td>
                <td>

                    <button class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin menghapus data ini')">
                        <a class="text-white text-decoration-none"
                            href="../function/delete.php?table_name=transactions_table&table_column=transaction_id&table_id=<?= $transaction['transaction_id'] ?>">
                            Delete
                        </a>
                    </button>

                    <button class="btn btn-warning btn-sm">
                        <a class="text-dark text-decoration-none"
                            href="?page=editTransaction&action=edit&id=<?= $transaction['transaction_id'] ?>">
                            Edit
                        </a>
                    </button>

                    <button class="btn btn-success btn-sm">
                        <a class="text-white text-decoration-none"
                            href=".?page=receiptPrinter&action=&id=<?= $transaction['transaction_id'] ?>">
                            Print
                        </a>
                    </button>

                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>