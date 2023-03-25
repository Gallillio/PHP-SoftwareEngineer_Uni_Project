<!-- This file is to display all employee records -->

<!-- connects to database -->
<?php
    #file that has db connection
    include '../db-Connection.php';
    
    #runs the open connection function
    $conn = OpenConnection();
    // echo "Connected Successfully";
    echo "<script> console.log('Database Connected Successful'); </script>";

    // get ID of row if delete button is clicked
    // if delete is clicked, ID variable is created, thereofr running this statement
    if (isset($_GET["ID"])){
        // SQL for delete line
        $id = $_GET["ID"];
        $deleteSQL = mysqli_query($conn, "DELETE FROM `users` WHERE `ID` = '$id' ");
    }

?>

<html>
    <head></head>
    <body>
        <table border="1">
            <th>ID</th>
            <th>username</th>
            <th>email</th>
            <th>password</th>
            <th>age</th>
            <th>gender</th>
            <th>usertype</th>
            <th>edit</th>
            <th>delete</th>
            
            <!-- adds the data -->
            <?php
                $sql = "SELECT * FROM users";
                $result = $conn -> query($sql);

                // checks if rows are more than 0 (is there any data inside table)
                if($result -> num_rows > 0){
                    while($row = $result -> fetch_assoc()){
                        // Switches the usertype numbering into its actual Name
                        if($row["usertype"] == 0){
                            $usertypeNamed = "Customer (Shouldn't be in this table)";
                        }
                        elseif($row["usertype"] == 1){
                            $usertypeNamed = "Administrator";
                        }
                        elseif($row["usertype"] == 2){
                            $usertypeNamed = "Worker";
                        }
                        else{
                            $usertypeNamed = "Something went wrong";
                        }
                        echo "
                        <tr>
                            <td>" . $row["ID"] . "</td>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["password"] . "</td>
                            <td>" . $row["age"] . "</td>
                            <td>" . $row["gender"] . "</td>
                            <td>" . $usertypeNamed . "</td>
                            <td> <a href='display-employee-data.php?ID=".$row["ID"] ."'> DELETE </a> </td>
                            <td> <a href='edit-employee-form.php?ID=".$row["ID"] ."'> Edit/Update </a> </td>
                        </tr>";
                    }
                }
                else{
                    echo "There is no data currently";
                    #should also make the table style disappear
                }

            ?>

        </table>
        <br>
        Add another User: <a href='add-employee-form.php'> Here </a>
    </body>
</html>

<?php
    #runs the close connection function
    CloseConnection($conn);
?>