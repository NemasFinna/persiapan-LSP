<?php
$dataCustomersTable = mysqli_query($connect, "SELECT * FROM customers_table");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Customers</h3>
    <a href="?page=addCustomer&action=add" class="btn btn-primary">+ Add Customer</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th width="150">Control</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($customer = $dataCustomersTable->fetch_assoc()): ?>
            <tr>
                <td><?= $customer['customer_id'] ?></td>
                <td><?= $customer['customer_name'] ?></td>
                <td><?= $customer['gender'] ?></td>
                <td><?= $customer['address'] ?></td>
                <td>

                    <!-- DELETE -->
                    <a href="../function/delete.php?table_name=customers_table&table_column=customer_id&table_id=<?= $customer['customer_id'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin hapus data ini?')">
                        Delete
                    </a>

                    <!-- EDIT -->
                    <a href="?page=editCustomer&action=edit&id=<?= $customer['customer_id'] ?>"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>