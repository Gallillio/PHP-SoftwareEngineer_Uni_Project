<a href="register/add-customer-form.php"> Head to User Register</a>
<br><br>
<a href="../login.php"> Head to Login Form</a>
<br><br>
<a href="view-account-details.php">Head to User View Account Details(and edit it)</a>
<!-- show order food or order details depending on if the user has an order right now or not -->
<?php
    if(isset($_SESSION["orderID"])){
        echo "<br><br>";
        echo "<a href='../order-details.php'>Order Details (and cancel) </a>";
    }
    else{
        echo "<br><br>
        After placing the food you can cancel it
        <br>
        <a href='../order-food.php'>Customer Order Food</a>"; 
    }
?>
