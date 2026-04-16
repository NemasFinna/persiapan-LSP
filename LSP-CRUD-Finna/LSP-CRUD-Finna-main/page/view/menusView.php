<?php
$dataMenusTable = mysqli_query($connect, "SELECT * FROM menus_table");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Menus</h3>
    <a href="?page=addMenu&action=add" class="btn btn-primary">+ Add Menu</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Menu ID</th>
            <th>Menu Name</th>
            <th>Price</th>
            <th width="150">Control</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($menu = $dataMenusTable->fetch_assoc()): ?>
            <tr>
                <td><?= $menu['menu_id'] ?></td>
                <td><?= $menu['menu_name'] ?></td>
                <td><?= $menu['price'] ?></td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin menghapus data ini')">
                        <a class="text-white text-decoration-none"
                            href="../function/delete.php?table_name=menus_table&table_column=menu_id&table_id=<?= $menu['menu_id'] ?>">
                            Delete
                        </a>
                    </button>

                    <button class="btn btn-warning btn-sm">
                        <a class="text-dark text-decoration-none"
                            href="?page=editMenu&action=edit&id=<?= $menu['menu_id'] ?>">
                            Edit
                        </a>
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>