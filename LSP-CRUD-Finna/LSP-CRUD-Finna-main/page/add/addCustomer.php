<?php

if(isset($_POST['addCustomer'])){
    $customer_name = $_POST['customer_name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $dataAddCustomer = mysqli_query($connect,"INSERT INTO customers_table (customer_name,gender,address) VALUES ('$customer_name','$gender','$address')");

    if($dataAddCustomer){
       echo "<script>
       window.location.href = 'index.php?page=customersView&action=view';
       alert('data berhasil dikirim');
       </script>" ;
    } else {
        echo mysqli_error($connect);
    }
}

?>

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <form method="POST" class="border p-4 rounded" style="width: 400px;">

        <h4 class="text-center mb-3">Add Customer</h4>

        <div class="mb-3">
            <label>Customer Name</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <button name="addCustomer" class="btn btn-primary w-100">Submit</button>

    </form>
</div>