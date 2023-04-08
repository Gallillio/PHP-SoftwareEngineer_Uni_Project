<!-- This page is for admin to view all order's reciepts from clients -->

<!-- to make session -->
<?php session_start(); ?>
    
<!-- connects to database -->
<?php
    #file that has db connection
    include "../db-connection.php";
    
    #runs the open connection function
    $conn = OpenConnection();
    // echo "Connected Successfully";
    echo "<script>console.log('Database Connected Successful');</script>";
?>
<table border='1'>
    <th>Client Name</th>
    <!-- ItemName(Quantity) - ItemName(Quantity) -->
    <th>Items Ordered</th>
    <th>Date</th>
    <th>Grand Total</th>
    
    <?php
    // order table query (for userID / date / grandTotal)
    $ordersQuery = "SELECT * FROM orders";
    $ordersResult = $conn -> query($ordersQuery);

    // orderitems table query (for foodItemID / quantity)
    $orderItemsQuery = "SELECT * FROM orderitems";
    $orderItemsResult = $conn -> query($orderItemsQuery);

    // users table query (for username)
    $usersQuery = "SELECT * FROM users";
    $usersResult = $conn -> query($usersQuery);

    // menuitems table query (for foodName)
    $menuItemQuery = "SELECT * FROM menuitems";
    $menuItemResult = $conn -> query($menuItemQuery);

    // // checks if rows are more than 0 (is there any data inside table)
    // if($ordersResult -> num_rows > 0){
             
    // }
    else{
        echo "There is no data currently";
        #should also make the table style disappear
    }
    ?>
</table>




<?php
    #runs the close connection function
    CloseConnection($conn);
?>