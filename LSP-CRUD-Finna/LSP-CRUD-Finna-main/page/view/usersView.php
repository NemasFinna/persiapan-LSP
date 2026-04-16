<?php
$dataUsersTable = mysqli_query($connect, "SELECT * FROM users_table");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Users</h3>
    <a href="?page=addUser&action=add" class="btn btn-primary">+ Add User</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
            <th width="150">Control</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($user = $dataUsersTable->fetch_assoc()): ?>
            <tr>
                <td><?= $user['user_id'] ?></td>
                <td><?= $user['full_name'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['password'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin menghapus data ini')">
                        <a class="text-white text-decoration-none"
                            href="../function/delete.php?table_name=users_table&table_column=user_id&table_id=<?= $user['user_id'] ?>">
                            Delete
                        </a>
                    </button>

                    <button class="btn btn-warning btn-sm">
                        <a class="text-dark text-decoration-none"
                            href="?page=editUser&action=edit&id=<?= $user['user_id'] ?>">
                            Edit
                        </a>
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>