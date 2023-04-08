<!-- This page is for admin only to view all order's reciepts from clients -->

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
    <th>Order ID</th>
    <th>Date</th>
    <th>Client Name</th>
    <th>Items Ordered</th>
    <th>Quantity</th>
    <th>Grand Total</th>
    
    <?php
    // order table query (for userID / date / grandTotal)
    // orderitems table query (for foodItemID / quantity)
    // users table query (for username)
    // menuitems table query (for foodName)

    // Join Query
    $query = 
    "SELECT orders.ID, users.username, orders.date, orders.totalPayment, menuitems.foodName, orderitems.quantity
    FROM orders
    JOIN users
    ON orders.userID = users.ID
    JOIN orderitems
    ON orders.ID = orderitems.orderID
    JOIN menuitems
    ON menuitems.ID = orderitems.foodItemID";

    $result = mysqli_query($conn, $query);
    
    // checks if rows are more than 0 (is there any data inside table)
    if($result -> num_rows > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo
            "
            <tr>
                <td>{$row['ID']}</td>
                <td>{$row['date']}</td>
                <td>{$row['username']}</td>
                <td>{$row['foodName']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['totalPayment']}</td>
            </tr>
            ";
        }
    }
    else{
        echo "There is no data currently";
        #should also make the table style disappear
    }
    ?>
</table>
<br><br>
<a href="../index.php">Go back to index</a>



<?php
    #runs the close connection function
    CloseConnection($conn);
?>