<!-- just the index that has a collection of the functions that the website will have -->

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

<!-- goes to appropriate page depending on userType if created or logged in -->
<?php
    // Get the data of the user from database(To be displayed even when updated)
    // because for whatever reason using the the session username variable doesnt get updated if the user updates their info
    $sql = "SELECT * FROM users WHERE `ID` ='". $_SESSION["ID"] ."'";
    $result = $conn -> query($sql);
    while($row = $result -> fetch_assoc()){
        $employeeUsername = $row["username"];
    }


    if (isset($_SESSION["ID"])){
        echo "Welcome <b>". $employeeUsername. "</b>!<br>";
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
<h3>This is all the links el fel website for convenience purposes</h3>

<a href="login.php"> Login Form</a>
<br><br>
<a href="view-menu.php"> View Menu</a>

<h4><i>Admin Pages</i></h4>
<a href="admin/add_employee/add-employee-form.php"> add Employee Record</a>
<br><br>
<a href="admin/add_menu_item/add-menu-item-form.php"> add new Food Item</a>
<br><br>
<a href="admin/view-all-reciepts.php"> View All Reciepts(Report)</a>

<h4><i>Customer Pages</i></h4>
<a href="customer/register/add-customer-form.php"> Customer Register</a>
<br><br>
<a href="customer/view-account-details.php">Customer View Account Details(and edit/delete it)</a>
<br><br>
<a href="order-food.php">Customer Order Food</a>

<?php
    #runs the close connection function
    CloseConnection($conn);
?>