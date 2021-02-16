<?php

require_once "utility_func.php";

require_once 'db.php';

$errors = [];


    $ticket_adult_price;
    $ticket_adult_quantity;
    $event_id;
    $event_date;
    $ticket_kid_price;
    $ticket_kid_quantity;
    $equal_price;
    $barcode;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $ticket_adult_price = $_POST['ticket_adult_price'] ?? 0;
    $ticket_adult_quantity = $_POST['ticket_adult_quantity'] ?? 0;
    $event_id = $_POST['event_id'] ?? '' ;
    $event_date = $_POST['event_date'] ?? '';
    $ticket_kid_price = $_POST['ticket_kid_price'] ?? 0 ;
    $ticket_kid_quantity = $_POST['ticket_kid_quantity'] ?? 0;
    $equal_price = $_POST['equal_price'] ?? 0;
    $ticket_group_price = $_POST['ticket_group_price'] ?? 0;
    $ticket_group_quantity = $_POST['ticket_group_quantity'] ?? 0;
    $ticket_discount_price = $_POST['ticket_discount_price'] ?? 0;
    $ticket_discount_quantity = $_POST['ticket_discount_quantity'] ?? 0;
    
    
    $barcode = [];
    $user_id = ('00'.randomNumber(3)) ?? '';
  

    if (!$event_id) {
        $errors[] = "Choose an event you'd like to participate in";
    }

    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO orders ( event_id, event_date, ticket_adult_price, ticket_adult_quantity, ticket_kid_price, ticket_kid_quantity, ticket_group_price, ticket_group_quantity, ticket_discount_price, ticket_discount_quantity,  barcode, user_id, equal_price, created)
                VALUES ( :event_id, :event_date, :ticket_adult_price, :ticket_adult_quantity, :ticket_kid_price, :ticket_kid_quantity, :ticket_group_price, :ticket_group_quantity, :ticket_discount_price, :ticket_discount_quantity,  :barcode, :user_id,  :equal_price, :created)");
       

    if($event_id == 003){
        $ticket_adult_price = 700;
        $ticket_kid_price = 450;
        $ticket_discount_price = 300;
        $ticket_group_price = 1200;
    }
    if($event_id == 006){
        $ticket_adult_price = 1000;
        $ticket_kid_price = 800;
        $ticket_discount_price = 500;
        $ticket_group_price = 1700;
    }  
    
       
    
    $ticket_adult_total = $ticket_adult_price * $ticket_adult_quantity;
    $ticket_kid_total = $ticket_kid_price * $ticket_kid_quantity;
    $ticket_group_total = $ticket_group_price * $ticket_group_quantity;
    $ticket_discount_total = $ticket_discount_price * $ticket_discount_quantity;
    $equal_price = $ticket_adult_total + $ticket_kid_total + $ticket_group_total + $ticket_discount_total;

    $total_ticket_quantity = $ticket_adult_quantity + $ticket_kid_quantity  + $ticket_group_quantity + $ticket_discount_quantity;
    
    for($i = 1; $i <= $total_ticket_quantity; $i++){
        array_push($barcode, randomNumber(8));
    }
          echo  implode(',', $barcode).'<br>';
        $barcode = implode(',', $barcode);

    
      if (!$equal_price) {
        $errors[] = 'Place an order by adding tickets';
    }

         $statement->bindValue(':event_id', $event_id);
         $statement->bindValue(':event_date', $event_date);
        $statement->bindValue(':ticket_adult_quantity', $ticket_adult_quantity);
        $statement->bindValue(':ticket_kid_quantity', $ticket_kid_quantity);
        $statement->bindValue(':ticket_kid_price', $ticket_kid_price);
        $statement->bindValue(':ticket_adult_price', $ticket_adult_price);
        $statement->bindValue(':ticket_group_price', $ticket_group_price);
        $statement->bindValue(':ticket_group_quantity', $ticket_group_quantity);
        $statement->bindValue(':ticket_discount_quantity', $ticket_discount_quantity);
        $statement->bindValue(':ticket_discount_price', $ticket_discount_price);
        $statement->bindValue(':equal_price', $equal_price);
        $statement->bindValue(':created', date('Y-m-d H:i:s'));
        $statement->bindValue(':barcode', $barcode);
        $statement-> bindValue(':user_id', $user_id);
        $statement->execute();
        header('Location: index.php');
    }
    
    
    echo date($event_date).'<br>';
    echo $event_id;

}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $(function() {
        $("#datepicker").datepicker();
    });
    </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet" />
    <title>Orders</title>
</head>

<body>
    <h1>Place new order</h1>

    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
        <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Event</label><br>
            <select name="event_id" id="event_id">
                <option disabled default>Выберите мероприятие</option>
                <option value="<?php echo $event_id = '003'?> ">003</option>
                <option value="<?php echo $event_id = '006' ?> ">006</option>
            </select>
        </div>
        <div class="form-group">
            <label>Event</label><br>
            <p>Date: <input type="text" id="datepicker" name='event_date' value="<?php echo $event_date?>"></p>
        </div>
        <div class="form-group">
            <label>Ticket adult quantity</label>
            <input type="number" name="ticket_adult_quantity" class="form-control"
                value="<?php echo $ticket_adult_quantity ?>">
        </div>
        <div class="form-group">
            <label>Ticket kid quantity</label>
            <input type="number" name="ticket_kid_quantity" class="form-control"
                value="<?php echo $ticket_kid_quantity ?>">
        </div>
        <div class="form-group">
            <label>Ticket group quantity</label>
            <input type="number" name="ticket_group_quantity" class="form-control"
                value="<?php echo $ticket_group_quantity ?>">
        </div>
        <div class="form-group">
            <label>Ticket discount quantity</label>
            <input type="number" name="ticket_discount_quantity" class="form-control"
                value="<?php echo $ticket_discount_quantity ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>

</html>