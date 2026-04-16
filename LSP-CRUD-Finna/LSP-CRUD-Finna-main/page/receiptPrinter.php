<?php

$id = (int) $_GET['id'];

$dataTransaction = mysqli_fetch_assoc(mysqli_query($connect, "
SELECT 
    transactions_table.*,
    menus_table.menu_name,
    menus_table.price,
    customers_table.customer_name,
    users_table.full_name,
    orders_table.amount
FROM transactions_table

JOIN orders_table 
    ON transactions_table.order_id = orders_table.order_id

JOIN menus_table 
    ON orders_table.menu_id = menus_table.menu_id

JOIN customers_table 
    ON orders_table.customer_id = customers_table.customer_id

JOIN users_table 
    ON orders_table.user_id = users_table.user_id

WHERE transactions_table.transaction_id = '$id'
"));

$change = $dataTransaction['payment'] - $dataTransaction['final_price'];

function rupiah($angka){
    return "Rp " . number_format($angka,0,',','.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Receipt</title>

<style>
    body {
        font-family: monospace;
        background: #f5f5f5;
    }

    .receipt {
        width: 300px;
        margin: 30px auto;
        background: white;
        padding: 20px;
        border: 1px dashed #000;
    }

    .center {
        text-align: center;
    }

    .line {
        border-top: 1px dashed #000;
        margin: 10px 0;
    }

    .flex {
        display: flex;
        justify-content: space-between;
    }

    button {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
    }

    @media print {
        button {
            display: none;
        }
        body {
            background: white;
        }
    }
</style>

</head>
<body>

<div class="receipt">

    <div class="center">
        <h3>RESTO APP</h3>
        <p>--------------------------</p>
    </div>

    <p>Transaction : #<?= $dataTransaction['transaction_id'] ?></p>
    <p>Order : #<?= $dataTransaction['order_id'] ?></p>
    <p>Cashier : <?= $dataTransaction['full_name'] ?></p>
    <p>Customer : <?= $dataTransaction['customer_name'] ?></p>

    <div class="line"></div>

    <div class="flex">
        <span><?= $dataTransaction['menu_name'] ?></span>
        <span><?= $dataTransaction['amount'] ?>x</span>
    </div>

    <div class="flex">
        <span>Price</span>
        <span><?= rupiah($dataTransaction['price']) ?></span>
    </div>

    <div class="flex">
        <span>Total</span>
        <span><?= rupiah($dataTransaction['final_price']) ?></span>
    </div>

    <div class="line"></div>

    <div class="flex">
        <strong>Payment</strong>
        <strong><?= rupiah($dataTransaction['payment']) ?></strong>
    </div>

    <div class="flex">
        <strong>Change</strong>
        <strong><?= rupiah($change) ?></strong>
    </div>

    <div class="line"></div>

    <div class="center">
        <p>Thank You 🙏</p>
    </div>

</div>

<button onclick="window.print()">🖨️ Print</button>

</body>
</html>