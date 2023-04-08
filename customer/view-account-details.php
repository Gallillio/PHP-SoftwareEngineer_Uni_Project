<!-- This file is to view Customer account details and edit it -->

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

<!-- When user clicks on submit button, run this section -->
<?php
    $sql = mysqli_query($conn, "SELECT ID FROM `users` WHERE `email` ='". $_SESSION["email"] . "'");
    $result = mysqli_fetch_array($sql);

    if(count($_POST) > 0){
        
        mysqli_query($conn," UPDATE `users` SET `username`='". $_POST['employeeUsername'] ."', `email`='". $_POST['employeeEmail'] ."',
        `password`='". $_POST['employeePassword'] ."',`age`='". $_POST['employeeAge'] ."', `gender`='',
        `address`='". $_POST['employeeAddress'] ."', `phoneNumber`='". $_POST['employeePhone'] ."'
        WHERE ID='". $result["ID"] ."'"); 

        echo "<script> console.log('Data Changed Successfully'); </script>";
    }

    //after submitting info
    if(isset($_POST["editInfoComplete"])){
        echo
        "
        <script>
        alert('Edited Info Successfully');
        document.location.href = '../index.php';
        </script>
        ";
    }

    // after deleting Account Completly
    if (isset($_GET["DeleteAccount"])){
        // SQL for delete line
        $id = $_GET["DeleteAccount"];
        $deleteSQL = mysqli_query($conn, "DELETE FROM `users` WHERE `ID` = '$id' ");
        
        // confirm deletion
        echo 
        "
        <script>
        alert('Account Deleted Successfully');
        document.location.href = '../index.php';
        </script>
        ";

        // destroys all session variables
    //    unset($_SESSION['counter']);
    }

?>

<html>
    <head>
        <style>
            /* so that the arrow that shows beside number input doesn't show */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <form method="post">
            <h2> Display / Edit / Delete Data </h2>
        
            Enter Username:<br>
            <input type="text" name="employeeUsername" value="<?php echo $_SESSION["username"] ?>" required><br><br>

            Enter Email:<br>
            <input type="email" name="employeeEmail" value="<?php echo $_SESSION["email"] ?> " readonly required><br><br>

            Enter Password:<br>
            <input type="password" name="employeePassword" value="<?php echo $_SESSION["password"] ?>" readonly required><br><br>

            Enter Age:<br>
            <input type="number" name="employeeAge" value="<?php echo $_SESSION["age"] ?>" required><br><br>

            Address:<br>
            <input type="text" name="employeeAddress" value="<?php echo $_SESSION["address"] ?>" required><br><br>

            Phone Number:<br>
            <input type="number" name="employeePhone" value="<?php echo $_SESSION["phone"] ?>" required><br><br> 

            <input type="submit" name="editInfoComplete">
            <br>
        </form>
        <!-- Button for deleting account -->
        <?php
            echo "<a href='view-account-details.php?DeleteAccount=".$_SESSION['ID'] ."'><button style='color:red;'> DELETE ACCOUNT </button></a>";
        ?>
    </body>
</html>
