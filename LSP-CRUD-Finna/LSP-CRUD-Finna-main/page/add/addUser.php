<?php
if(isset($_POST['addUser'])){
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $dataAddUser = mysqli_query($connect,"INSERT INTO users_table (full_name,username,password,role) VALUES ('$full_name','$username','$password','$role')");

    if($dataAddUser){
       echo "<script>
       window.location.href = 'index.php?page=usersView&action=view';
       alert('data berhasil dikirim');
       </script>" ;
    } else {
        echo mysqli_error($connect);
    }
}
?>

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <form method="POST" class="border p-4 rounded" style="width: 400px;">

        <h4 class="mb-3 text-center">Add User</h4>

        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="text" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="Administrator">Administrator</option>
                <option value="Waiter">Waiter</option>
                <option value="Cashier">Cashier</option>
                <option value="Owner">Owner</option>
                <option value="Manager">Manager</option>
            </select>
        </div>

        <button name="addUser" class="btn btn-primary w-100">Submit</button>

    </form>
</div>