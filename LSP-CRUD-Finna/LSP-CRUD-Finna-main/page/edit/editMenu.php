<?php

$id = $_GET['id'];

$dataMenu = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM menus_table WHERE menu_id = '$id'"));

if(isset($_POST['editMenu'])){
    $menu_name = $_POST['menu_name'];
    $price = $_POST['price'];

    $dataEditMenu = mysqli_query($connect,"UPDATE menus_table SET
    menu_name = '$menu_name',
    price = '$price'
    WHERE menu_id = '$id'");

    if($dataEditMenu){
       echo "<script>
       alert('data berhasil diedit');
       window.location.href = 'index.php?page=menusView&action=view';
       </script>" ;
    } else {
        echo mysqli_error($connect);
    }
}

?>

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <form method="POST" class="border p-4 rounded" style="width: 400px;">

        <h4 class="text-center mb-3">Edit Menu</h4>

        <div class="mb-3">
            <label>Menu Name</label>
            <input type="text" name="menu_name" value="<?= $dataMenu['menu_name'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" value="<?= $dataMenu['price'] ?>" class="form-control" required>
        </div>

        <button name="editMenu" class="btn btn-warning w-100">Update</button>

    </form>
</div>