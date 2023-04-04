<!-- just the index that has a collection of the functions that the website will have -->

<!-- to make session -->
<?php session_start(); ?>
    
<!-- goes to appropriate page depending on userType if created or logged in -->
<?php


if (isset($_SESSION["username"])){
    echo "Welcome <b>". $_SESSION["username"]. "</b>!<br>";
    // changes the userType from the integer value to its actual name
    if($_SESSION["userType"] == 0){
        echo "You are a Customer user account, head to Customer Logged in page:";
        echo "<a href='customer/customer-logged.php'>HERE</a>";
    }
    elseif($_SESSION["userType"] == 1){
        echo "You are a Admin user account, head to Admin Logged in page:";
        echo "<a href='admin/admin-logged.php'>HERE</a>";
    }
    elseif($_SESSION["userType"] == 2){
        echo "You are a Worker user account, head to Admin Logged in page:";
        // echo "<a href='worker/worker-logged.php'>HERE</a>";
    }
    else{
        echo "tab enta eh tayeb enta mesh fel user types enta";
    }
    echo "<br><br>";
}
else{
    echo "No account so far <br>";
}
?>

------------------------------------------------------------
<h4>This is all the links el fel website for convenience purposes</h4>

<a href="login.php"> Head to Login Form</a>
<br><br>
<a href="admin/add_employee/add-employee-form.php"> Head to adding Employee Record</a>
<br><br>
<a href="admin/add_menu_item/add-menu-item-form.php"> Head to adding new Food Item</a>
<br><br>
<a href="customer/register/add-customer-form.php"> Head to User Register</a>
<br><br>
<a href="customer/view-account-details.php">Head to User View Account Details(and edit it)</a>
<br><br>