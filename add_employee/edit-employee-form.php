<!-- This file is to edit an employee's data-->

<!-- connects to database -->
<?php
    #file that has db connection
    include '../db-Connection.php';
    
    #runs the open connection function
    $conn = OpenConnection();
    // echo "Connected Successfully";
    echo "<script> console.log('Database Connected Successful'); </script>";
?>

<!-- When user clicks on submit button, run this section -->
<?php
    if(count($_POST) > 0){
        mysqli_query($conn, "UPDATE `users` SET `username`='". $_POST['employeeUsername'] ."',`email`='". $_POST['employeeEmail'] ."', 
        `password`='". $_POST['employeePassword'] ."',`age`='". $_POST['employeeAge'] ."',`gender`='". $_POST['employeeGender'] ."',`usertype`='". $_POST['userType'] ."'
        WHERE ID='". $_GET['ID'] ."' ");
        echo "<script> console.log('Record Changed Successfully'); </script>";
        $succuessMessage = "<p style='color:green'> Record Changed Successfully, <a href='display-employee-data.php'>click here to go back</a></p>";
    }

    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE ID='". $_GET['ID'] ."'");
    $row = mysqli_fetch_array($result);
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
            <h2> Edit Employee Record </h2>
            
            <!-- shows success message when successful -->
            <?php if(isset($succuessMessage)){ echo $succuessMessage;}?>

            <!-- will send the submitted data to that file where it will be added to the database -->
            Enter Type of User: <br>
            <select name="userType" required>
                <!-- admin -> 1   /   worker -> 2 -->
                <option value="<?php echo $row['usertype'] ?>"> Worker </option>
                <option value="<?php echo $row['usertype'] ?>"> Administrator </option>
            </select><br><br>
        
            Enter Username:<br>
            <input type="text" name="employeeUsername" value="<?php echo $row['username'] ?>" required><br><br>

            Enter Email:<br>
            <input type="email" name="employeeEmail" value="<?php echo $row['email'] ?>" required><br><br>

            Enter Password:<br>
            <input type="password" name="employeePassword" value="<?php echo $row['password'] ?>" required><br><br>

            Enter Age:<br>
            <input type="number" name="employeeAge" value="<?php echo $row['age'] ?>" required><br><br>

            Gender:<br>
            Male <input type="radio" name="employeeGender" value="m" required> Female <input type="radio" name="employeeGender" value="f" required><br><br>

            <input type="submit">
        </form>
    </body>
</html>