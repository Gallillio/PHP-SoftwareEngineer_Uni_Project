<!-- Validates login data inputted and then goes to the appropriate page depending on the userType -->

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
    // fetches the inputted data
    $inputtedEmail = $_POST["inputtedEmail"];
    $inputtedPass = $_POST["inputtedPassword"];

    //query to select all data from users table
    $sql = "SELECT * FROM users";
    $result = $conn -> query($sql);

    while($row = $result -> fetch_assoc()){
        // if inputted email and pass are found in database
        if ($row["email"] == $inputtedEmail && $row["password"] == $inputtedPass){
            $employeeUsername = $row["username"];
            $employeeEmail = $row["email"];
            $employeePassword = $row["password"];
            $employeeAge = $row["age"];
            $employeeGender = $row["gender"];
            $employeeAddress = $row["address"];
            $employeePhone = $row["phoneNumber"];
            $userType = $row["usertype"];

            echo "successful <br>";
            echo "<script>console.log('Found Account Details');</script>";

            //sets session username to the username just created
            $_SESSION["username"] = $employeeUsername;
            $_SESSION["email"] = $employeeEmail;
            $_SESSION["password"] = $employeePassword;
            $_SESSION["age"] = $employeeAge;
            $_SESSION["gender"] = $employeeGender;
            $_SESSION["address"] = $employeeAddress;
            $_SESSION["phone"] = $employeePhone;
            $_SESSION["userType"] = $userType;
            break;
        }
        // elseif($row["email"] != $inputtedEmail || $row["password"] != $inputtedPass){
        //     die("no account");
        // }
    }
    
    #goes to index page after finding the account in database
    header("Location: index.php");



    // echo $row["ID"] . ": " . $row["email"] . " ". $userType;
?>




<?php
    #runs the close connection function
    CloseConnection($conn);
?>