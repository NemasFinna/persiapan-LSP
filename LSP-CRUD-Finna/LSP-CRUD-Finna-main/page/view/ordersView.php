<?php
$dataOrdersTable = mysqli_query($connect, "
SELECT 
    orders_table.*,
    menus_table.menu_name,
    customers_table.customer_name,
    users_table.full_name
FROM orders_table
JOIN menus_table 
    ON orders_table.menu_id = menus_table.menu_id
JOIN customers_table 
    ON orders_table.customer_id = customers_table.customer_id
JOIN users_table 
    ON orders_table.user_id = users_table.user_id
");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Orders</h3>
    <a href="?page=addOrder&action=add" class="btn btn-primary">+ Add Order</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Order ID</th>
            <th>Menu ID</th>
            <th>Menu Name</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>User ID</th>
            <th>Cashier Name</th>
            <th>Amount</th>
            <th width="150">Control</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($order = $dataOrdersTable->fetch_assoc()): ?>
            <tr>
                <td><?= $order['order_id'] ?></td>
                <td><?= $order['menu_id'] ?></td>
                <td><?= $order['menu_name'] ?></td>
                <td><?= $order['customer_id'] ?></td>
                <td><?= $order['customer_name'] ?></td>
                <td><?= $order['user_id'] ?></td>
                <td><?= $order['full_name'] ?></td>
                <td><?= $order['amount'] ?></td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin menghapus data ini')">
                        <a class="text-white text-decoration-none"
                            href="../function/delete.php?table_name=orders_table&table_column=order_id&table_id=<?= $order['order_id'] ?>">
                            Delete
                        </a>
                    </button>

                    <button class="btn btn-warning btn-sm">
                        <a class="text-dark text-decoration-none"
                            href="?page=editOrder&action=edit&id=<?= $order['order_id'] ?>">
                            Edit
                        </a>
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>