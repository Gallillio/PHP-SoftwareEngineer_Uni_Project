<!-- after confirming the order, it will be added to the database -->

<!-- to make session -->
<?php session_start(); ?>
    
<!-- connects to database -->
<?php
    #file that has db connection
    include "db-connection.php";
    
    #runs the open connection function
    $conn = OpenConnection();
    // echo "Connected Successfully";
    echo "<script>console.log('Database Connected Successful');</script>";
?>

<?php

$totalArray = array();
foreach($_SESSION["cart"] as $key => $val){
    $sql = "SELECT * FROM menuitems WHERE ID= '$key'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // get subtotal
    $subtotal = $_SESSION["cart"][$key][1];
    array_push($totalArray, $subtotal);

    
}


// Queries to add to database
$userID = $_SESSION['ID'];
$grandTotal = array_sum($totalArray);
date_default_timezone_set("Africa/Cairo");
$date = date("d/m/Y - h:i:sa");

// add to orders table
$ordersQuery = "INSERT INTO orders VALUES('','$date', '$userID', '$grandTotal')";
mysqli_query($conn, $ordersQuery);

// add to orderItems
$getOrderIDQuery = "SELECT ID FROM orders WHERE date='$date'";
$getOrderIDResult = mysqli_query($conn, $getOrderIDQuery);
$row = mysqli_fetch_assoc($getOrderIDResult);
$getOrderIDValue = array_values($row)[0];
echo $getOrderIDValue;

echo "<br>";
print_r ($_SESSION["cart"]);
echo "<br>";

foreach($_SESSION["cart"] as $key => $val){
    $quantity = $_SESSION["cart"][$key][0];
    $orderItemsQuery = "INSERT INTO orderitems VALUES('', '$getOrderIDValue', $key, '$quantity')";

    mysqli_query($conn, $orderItemsQuery);

    // get ID of order to make session with it so we can edit and cancel order later
    $_SESSION["orderID"] = $getOrderIDValue;
}



// delete cart after being done
unset($_SESSION['cart']);

// head to order confirmed
header("Location: order-details.php");


?>