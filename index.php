<?php


require_once 'db.php';

$statement = $pdo->prepare('SELECT * FROM orders ORDER BY id ASC');
$statement->execute();
$orders = $statement->fetchAll(PDO::FETCH_ASSOC);
?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet" />
    <title>TestTask</title>
</head>

<body>
    <h1>Orders</h1>

    <p>
        <a href="create.php" type="button" class="btn btn-sm btn-success">Add Order</a>
    </p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">event_id</th>
                <th scope="col">event_date</th>
                <th scope="col">ticket_adult_price</th>
                <th scope="col">ticket_adult_quantity</th>
                <th scope="col">ticket_kid_price</th>
                <th scope="col">ticket_kid_quantity</th>
                <th scope="col">ticket_group_price</th>
                <th scope="col">ticket_group_quantity</th>
                <th scope="col">ticket_discount_price</th>
                <th scope="col">ticket_discount_quantity</th>
                <th scope="col">barcode</th>
                <th scope="col">user_id</th>
                <th scope="col">equal_price</th>
                <th scope="col">created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $i => $order) { ?>
            <tr>
                <th scope="row"><?php echo $i + 1 ?></th>
                <td><?php echo $order['event_id'] ?></td>
                <td><?php echo $order['event_date'] ?></td>
                <td><?php echo $order['ticket_adult_price'] ?></td>
                <td><?php echo $order['ticket_adult_quantity'] ?></td>
                <td><?php echo $order['ticket_kid_price'] ?></td>
                <td><?php echo $order['ticket_kid_quantity'] ?></td>
                <td><?php echo $order['ticket_group_price'] ?></td>
                <td><?php echo $order['ticket_group_quantity'] ?></td>
                <td><?php echo $order['ticket_discount_price'] ?></td>
                <td><?php echo $order['ticket_discount_quantity'] ?></td>
                <td class="barcode"><?php echo $order['barcode'] ?></td>
                <td><?php echo $order['user_id'] ?></td>
                <td><?php echo $order['equal_price'] ?></td>
                <td><?php echo $order['created'] ?></td>
                <td>
                    <form method="post" action="delete.php" style="display: inline-block">
                        <input type="hidden" name="id" value="<?php echo $order ['id'] ?>" />
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>