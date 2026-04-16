<?php

if(isset($_POST['addMenu'])){
    $menu_name = $_POST['menu_name'];
    $price = $_POST['price'];

    $dataAddMenu = mysqli_query($connect,"INSERT INTO menus_table (menu_name,price) VALUES ('$menu_name','$price')");

    if($dataAddMenu){
       echo "<script>
       window.location.href = 'index.php?page=menusView&action=view';
       alert('data berhasil dikirim');
       </script>" ;
    } else {
        echo mysqli_error($connect);
    }
}

?>

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <form method="POST" class="border p-4 rounded" style="width: 400px;">

        <h4 class="text-center mb-3">Add Menu</h4>

        <div class="mb-3">
            <label>Menu Name</label>
            <input type="text" name="menu_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <button name="addMenu" class="btn btn-primary w-100">Submit</button>

    </form>
</div>