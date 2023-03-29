<!-- This file is to add and disolay employee records -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

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
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Foul court</title>
    
</head>
 
<body>
    <header>
        <h3 class="title">Foul court <a href="../../" style="color: red;"> (Click Here to return to index)</a></h3>
    </header>    
    <div class="container">
        <div class="btn">
            <button class="login">Register</button>
            <button class="signup">Records</button>
        </div>
        
        <!-- Form -->
        <form action="send-register-employee-data.php" method="post">
            <div class="form-section">
                <!-- NEW Employee -->
                <div class="enter-box">
                    <div class="usertypeSection">
                        <select class="select" name="userType" required>
                            <!-- admin -> 1   /   worker -> 2 -->
                            <option value="2"> Worker </option>
                            <option value="1"> Administrator </option>
                        </select>
                        <div style="color: white; margin-left: 30px;">
                            Gender:
                            Male <input type="radio" name="employeeGender" value="m" required> Female <input type="radio" name="employeeGender" value="f" required>
                        </div>
                    </div>
                    <input type="text"
                        class="name ele"
                        name="employeeUsername"
                        placeholder="Enter your name">
                    <input type="email"
                        class="email ele"
                        name="employeeEmail"
                        placeholder="youremail@email.com">
                    <input type="password"
                        class="password ele"
                        name="employeePassword"
                        placeholder="password">
                    <input type="number"
                        class="password ele"
                        name="employeeAge"
                        placeholder="Enter your age ">

                    <input type="text"
                        class="password ele"
                        name="employeeAddress"
                        placeholder="Enter your address">
                    <input type="number"
                        class="password ele"
                        name="employeePhone"
                        placeholder="Enter your phone number">
                    <button class="clkbtn">Add</button>
            </div>
        </form>   
    
            <!-- record form -->
            <?php
                #file that has db connection
                include '../../db-Connection.php';
                
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

            <div class="record-box">
                <table class="table" border="1">
                    <th style="padding: 3px">ID</th>
                    <th style="padding: 3px">Username</th>
                    <th style="padding: 3px">Email</th>
                    <th style="padding: 3px">Password</th>
                    <th style="padding: 3px">Age</th>
                    <th style="padding: 3px">Gender</th>
                    <th style="padding: 3px">Address</th>
                    <th style="padding: 3px">Phone Number</th>
                    <th style="padding: 3px">UserType</th>
                    <th style="padding: 3px">Delete</th>
                    <th style="padding: 3px">Edit</th>

                    <!-- adds the data -->
                    <?php
                        // function will be used to display only the rows with the admin or worker usertype, and wont display client
                        function displayRow($row, $usertypeNamed){
                            echo "
                            <tr>
                                <td style='padding: 3px'>" . $row["ID"] . "</td>
                                <td style='padding: 3px'>" . $row["username"] . "</td>
                                <td style='padding: 3px'>" . $row["email"] . "</td>
                                <td style='padding: 3px'>" . $row["password"] . "</td>
                                <td style='padding: 3px'>" . $row["age"] . "</td>
                                <td style='padding: 3px'>" . $row["gender"] . "</td>
                                <td style='padding: 3px'>" . $row["address"] . "</td>
                                <td style='padding: 3px'>" . $row["phoneNumber"] . "</td>
                                <td style='padding: 3px'>" . $usertypeNamed . "</td>
                                <td style='padding: 3px'> <a style='color: red;' href='add-employee-form.php?ID=".$row["ID"] ."'> DELETE </a> </td>
                                <td style='padding: 3px'> <a style='color: blue;' href='edit-employee-form.php?ID=".$row["ID"] ."'> Edit </a> </td>
                            </tr>";
                        }

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
                                    displayRow($row, $usertypeNamed);
                                }
                                elseif($row["usertype"] == 2){
                                    $usertypeNamed = "Worker";
                                    displayRow($row, $usertypeNamed);
                                }
                                else{
                                    $usertypeNamed = "Something went wrong";
                                    displayRow($row, $usertypeNamed);
                                }
                            }
                        }
                        else{
                            echo "There is no data currently";
                            #should also make the table style disappear
                        }
                    ?>
                </table>
            </div>  
        </div>
    </div>
    
</body>
 <script>
    let signup = document.querySelector(".signup");
let login = document.querySelector(".login");
let slider = document.querySelector(".slider");
let formSection = document.querySelector(".form-section");

signup.addEventListener("click", () => {
	slider.classList.add("moveslider");
	formSection.classList.add("form-section-move");
});

login.addEventListener("click", () => {
	slider.classList.remove("moveslider");
	formSection.classList.remove("form-section-move");
});

 </script>
</html>
</body>
</html>
<?php
    #runs the close connection function
    CloseConnection($conn);
?>