<!-- file after confirming order, this file is for cancelling order if wanted -->

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

<!-- if delete button is pressed -->
<?php
    if (isset($_GET["delete"])){
        $orderID = $_SESSION["orderID"];
        $deleteSQL = mysqli_query($conn, "DELETE FROM `orders` WHERE `ID` = '$orderID' ");
        echo 
        "
        <script> 
            alert('Order Cancelled');
            document.location.href = 'index.php'; 
        </script>
        ";
        // after deleting account, also delete orderID session
        unset($_SESSION['orderID']);
    }
?>


<h3>Order Confirmed</h3>
<?php
    
    $getDataQuery = 
    "SELECT orders.ID, orders.date, menuitems.foodName ,orders.totalPayment
    FROM orders
    JOIN orderitems
    ON orders.ID = orderitems.orderID
    JOIN users
    ON users.ID = orders.userID
    JOIN menuitems
    ON menuitems.ID = orderitems.foodItemID
    WHERE orders.ID = {$_SESSION['orderID']}";

    $result = mysqli_query($conn, $getDataQuery);

    echo "Your Order ID is: <b>{$_SESSION["orderID"]}</b> <br><br>";
    echo "You Ordered:";
    while($row = $result -> fetch_assoc()){
        echo "<li>{$row["foodName"]}</li>";
    }
?>
<div>
    <br>
    <a href="order-details.php?delete=True"><button>Cancel Order?</button></a>
    <br><br>
    or
    <br><br>
</div>



<a href="index.php">Head back to Index Page</a>

