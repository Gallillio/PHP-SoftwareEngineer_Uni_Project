<!-- This page is to get the ID from the database for the newly registered user so that we can create a session with it-->

<!-- to make session -->
<?php session_start(); ?>

<!-- connects to database -->
<?php
    #file that has db connection
    include "../../db-connection.php";
    
    #runs the open connection function
    $conn = OpenConnection();
    // echo "Connected Successfully";
    echo "<script>console.log('Database Connected Successful');</script>";
?>

<?php
//query to select all data from users table
$sql = "SELECT ID FROM `users` WHERE `email` ='". $_SESSION["email"] . "'";   
$result = $conn -> query($sql);

while($row = $result -> fetch_assoc()){
    $employeeID = $row["ID"];

    echo "successful <br>";
    echo "<script>console.log('Found Account Details');</script>";

    //sets session info to the info just created
    $_SESSION["ID"] = $employeeID;
    break;
    // elseif($row["email"] != $inputtedEmail || $row["password"] != $inputtedPass){
    //     die("no account");
    // }
}

echo $_SESSION["ID"]
?>


<?php
    //runs the close connection function
    CloseConnection($conn);

    // header("Location: ../../index.php");
?>
