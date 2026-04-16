<?php

$id = $_GET['id'];

$dataCustomer = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM customers_table WHERE customer_id = '$id'"));

if(isset($_POST['editCustomer'])){
    $customer_name = $_POST['customer_name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $dataEditCustomer = mysqli_query($connect,"UPDATE customers_table SET
    customer_name = '$customer_name',
    gender = '$gender',
    address = '$address'
    WHERE customer_id = '$id'");

    if($dataEditCustomer){
       echo "<script>
       alert('data berhasil diedit');
       window.location.href = 'index.php?page=customersView&action=view';
       </script>" ;
    } else {
        echo mysqli_error($connect);
    }
}

?>

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <form method="POST" class="border p-4 rounded" style="width: 400px;">

        <h4 class="text-center mb-3">Edit Customer</h4>

        <div class="mb-3">
            <label>Customer Name</label>
            <input type="text" name="customer_name" value="<?= $dataCustomer['customer_name'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="Male" <?= ($dataCustomer['gender'] == "Male") ? "selected" : '' ?>>Male</option>
                <option value="Female" <?= ($dataCustomer['gender'] == "Female") ? "selected" : '' ?>>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" value="<?= $dataCustomer['address'] ?>" class="form-control" required>
        </div>

        <button name="editCustomer" class="btn btn-warning w-100">Update</button>

    </form>
</div>