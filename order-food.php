<!-- this page is for customers and workers to order food from, it will display menu items(that are added by the admin) and they can add items to order list and then check out -->

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

<!-- For Order Cart -->
<?php
    // if session cart isnt created, create it.
    if (!(isset($_SESSION["cart"]))){
        $_SESSION["cart"] = array();
    }
    // unset($_SESSION['cart']);
    print_r($_SESSION["cart"]);

    // Add to cart
    if(isset($_GET["ID"])){
        $ID = $_GET["ID"];
        $price = $_GET["price"];
        $quantity = $_GET["quantity"];
        // calculate subtotal
        $subtotal = $price * $quantity;

        // quantity validation
        if($quantity > 0){
            // if item is already in the cart
            if(isset($_SESSION["cart"][$ID])){
                echo 
                "
                <script> 
                    alert('Item Already in cart bro');
                    document.location.href = 'order-food.php'; 
                </script>
                ";
            }
            // if item isnt in the cart
            else{
                $_SESSION["cart"][$ID] = array($quantity, $subtotal);
                header("Location: order-food.php");
            }
        }
        else{
            echo 
            "
            <script> 
                alert('Put a number bro');
                document.location.href = 'order-food.php'; 
            </script>
            ";
        }
    }
?>

<?php

    // function to filter out the item depending on the food Type of the item
    function filterer($conn, $foodType){
        // have to reset the value in $result every time for I am filtering out the item (if it is a Main course or Dessert or Appetizer or Drink)
        $sql = "SELECT * FROM menuitems";
        
        // foodType will be from 1 to 4 depending on the foodType table in the Database
        $result = $conn -> query($sql);
        
        echo
        "
        <table border='1'>
            <tr>
        ";

        while($row = $result -> fetch_assoc()){
            if($row["foodCategory"] == $foodType){

                echo 
                "
                <td><img src='admin/add_menu_item/img/".$row['image'] ."' width='200'></td>
                <td>". $row['foodName'] ."</td>
                <td>". $row['foodPrice'] ." LE</td>
                <form method='GET' action='#'>
                    <input type='hidden' name='ID' id='ID' value='". $row['ID'] ."'>
                    <input type='hidden' name='price' id='price' value='". $row['foodPrice'] ."'>
                    <td> <input type='number' name='quantity'></td>
                    <td> <input type='submit' value='Add to Order Cart'> </td>
                </form>
                </tr>
                ";
            }
        }
        echo
        "
        </table>
        ";
    }
?>

<div>
    <a href="view-order-cart.php"><h2> Order Cart </h2></a>
</div>

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
</div>

<?php
    #runs the close connection function
    CloseConnection($conn);
?>