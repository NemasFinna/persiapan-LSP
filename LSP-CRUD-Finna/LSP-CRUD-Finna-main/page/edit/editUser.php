<?php

$id = $_GET['id'];  

$dataUser = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users_table WHERE user_id = '$id'"));

if (isset($_POST['updateUser'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $dataEditUser = mysqli_query($connect, "UPDATE users_table SET
    full_name = '$full_name',
    username = '$username',
    password = '$password',
    role = '$role'
    WHERE user_id = '$id'");

    if ($dataEditUser) {
        echo "<script>
       alert('data berhasil dirubah');
       window.location.href = 'index.php?page=usersView&action=view';
       </script>";
    } else {
        echo mysqli_error($connect);
    }
}

?>

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <form method="POST" class="border p-4 rounded" style="width: 400px;">

        <h4 class="text-center mb-3">Edit User</h4>

        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="full_name" value="<?= $dataUser['full_name'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" value="<?= $dataUser['username'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="text" name="password" value="<?= $dataUser['password'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="Administrator" <?= ($dataUser['role'] == 'Administrator') ? 'selected' : '' ?>>Administrator</option>
                <option value="Waiter" <?= ($dataUser['role'] == 'Waiter') ? 'selected' : '' ?>>Waiter</option>
                <option value="Cashier" <?= ($dataUser['role'] == 'Cashier') ? 'selected' : '' ?>>Cashier</option>
                <option value="Owner" <?= ($dataUser['role'] == 'Owner') ? 'selected' : '' ?>>Owner</option>
                <option value="Manager" <?= ($dataUser['role'] == 'Manager') ? 'selected' : '' ?>>Manager</option>
            </select>
        </div>

        <button name="updateUser" class="btn btn-warning w-100">Update User</button>

    </form>
</div>