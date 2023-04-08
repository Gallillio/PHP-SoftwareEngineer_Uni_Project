<!-- This file is the process to add new customer to database -->

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
    $employeeUsername = $_POST["employeeUsername"];
    $employeeEmail = $_POST["employeeEmail"];
    $employeePassword = $_POST["employeePassword"];
    $employeeAge = $_POST["employeeAge"];
    $employeeGender = $_POST["employeeGender"];
    $employeeAddress = $_POST["employeeAddress"];
    $employeePhone = $_POST["employeePhone"];
    $userType = 0;

    #sql to send data
    $sendData = $conn->prepare("insert into users(username, email, password, age, gender, address, phoneNumber, usertype)
        values(?,?,?,?,?,?,?,?)");
    #data types
    $sendData -> bind_param("sssissii", $employeeUsername, $employeeEmail, $employeePassword, $employeeAge, $employeeGender, $employeeAddress, $employeePhone, $userType);
    $sendData -> execute();
    $sendData -> close();
?>

<?php
    //sets session username to the username just created
    $_SESSION["username"] = $employeeUsername;
    $_SESSION["email"] = $employeeEmail;
    $_SESSION["password"] = $employeePassword;
    $_SESSION["age"] = $employeeAge;
    $_SESSION["gender"] = $employeeGender;
    $_SESSION["address"] = $employeeAddress;
    $_SESSION["phone"] = $employeePhone;
    $_SESSION["userType"] = 0;

    //runs the close connection function
    CloseConnection($conn);

    #returns to page to get his id for to make session
    header("Location: get-registered-id.php");
    die();
?>