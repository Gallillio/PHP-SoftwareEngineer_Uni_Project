<!-- This file is the process to add a new menu item to the database -->

<!-- connects to database -->
<?php
    #file that has db connection
    include "../db-connection.php";
    
    #runs the open connection function
    $conn = OpenConnection();
    // echo "Connected Successfully";
    echo "<script>console.log('Database Connected Successful');</script>";
?>

<?php
    $foodName = $_POST["foodName"];
    $foodPrice = $_POST["foodPrice"];
    $foodCategory = $_POST["foodCategory"];


    #sql to send data
    $sendData = $conn->prepare("INSERT INTO foodmenu(foodName, foodPrice, foodCategory)
        VALUES(?,?,?)");
    #data types 
    $sendData -> bind_param("sii", $foodName, $foodPrice, $foodCategory);
    $sendData -> execute();
    $sendData -> close();
?>


<?php
    #runs the close connection function
    CloseConnection($conn);

    #returns to main page
    header("Location: display-menu-data.php");
    die();
?>