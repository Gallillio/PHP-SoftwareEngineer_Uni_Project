<!-- This page is for every user to view the menu items (that are added by the adminstrator) -->

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

    // function to filter out the item depending on the food Type of the item
    function filterer($conn, $foodType){
        // have to reset the value in $result every time for I am filtering out the item (if it is a Main course or Dessert or Appetizer or Drink)
        $sql = "SELECT * FROM menuitems";
        
        // foodType will be from 1 to 4 depending on the foodType table in the Database
        $result = $conn -> query($sql);

        while($row = $result -> fetch_assoc()){
            if($row["foodCategory"] == $foodType){
                echo 
                "
                <li>". $row['foodName'] ." - ". $row['foodPrice'] ." Pounds </li>
                ";
            }
            else{
                continue;
            }
        }
    }
?>

<div>
    <h3>Main Course</h3>
    <!-- filters out only Main Course items -->
    <?php
        filterer($conn, 1);
    ?>
</div>
<div>
    <h3>Dessert</h3>
    <!-- filters out only Dessert items -->
    <?php
        filterer($conn, 2);
    ?>
</div>
<div>
    <h3>Appetizer</h3>
    <!-- filters out only Appetizer items -->
    <?php
        filterer($conn, 3);
    ?>
</div>
<div>
    <h3>Drinks</h3>
    <!-- filters out only Drinks items -->
    <?php
        filterer($conn, 4);
    ?>
</div>

<br><br>
<div>
    <a href="index.php">Go Back To Index</a>
    <br>
    <br>
    <!-- Displays add menu if admin, or nothing if youre a user or worker -->
    <?php
        if ($_SESSION["userType"] == 1){
            echo "<a href='admin/add_menu_item/add-menu-item-form.php'>Add Menu Item (will be only available )</a>";
        }
        else{
            echo "<b>Login with Admin if you want to add item</b>";
        }
    ?>
</div>

<?php
    #runs the close connection function
    CloseConnection($conn);
?>