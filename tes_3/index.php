<?php
require_once __DIR__ . '/config/connection.php';

$transactionAll = $con->query("SELECT 
    a.*, 
    b.transaction_id,
    COUNT(b.item) as total_item,
    SUM(b.quantity) as total_quantity
FROM transactions a
JOIN transactiondetails b ON a.id=b.transaction_id
GROUP BY a.id");

$transactionGetAll = $transactionAll->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programming Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="flex mt-3">
            <div class="card">
                <div class="card-body">
                    Programming Test : Build Simple Apps
                </div>
            </div>
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Transaksi</th>
                            <th scope="col">Total Item</th>
                            <th scope="col">Total Quantity</th>
                        </tr>   
                    </thead>
                    <tbody>
                        <?php foreach ($transactionGetAll as $getTransaction) { ?>
                            <tr>
                                <th scope="row"><?= $getTransaction['id'] ?></th>
                                <td><?= $getTransaction['no_transaction'] ?></td>
                                <td><?= $getTransaction['total_quantity'] ?></td>
                                <td><?= $getTransaction['total_quantity'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>