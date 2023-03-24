<!-- This file is to edit menu item's data-->

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
        mysqli_query($conn, "UPDATE `foodmenu` SET `foodName`='". $_POST['foodName'] ."',`foodPrice`='". $_POST['foodPrice'] ."',`foodCategory`='". $_POST['foodCategory'] ."' WHERE ID='". $_GET['ID'] ."' ");
        // mysqli_query($conn, "UPDATE `foodmenu` SET `foodCategory`='". $_POST['foodCategory'] ."',`foodPrice`='". $_POST['foodPrice'] ."',`foodName`='". $_POST['foodName'] ."' WHERE ID='". $_GET['ID'] ."' ");
        echo "<script> console.log('Menu Item Changed Successfully'); </script>";
        $succuessMessage = "<p style='color:green'> Menu Item Changed Successfully. <a href='display-employee-data.php'>click here to go back</a></p>";
    }

    $result = mysqli_query($conn, "SELECT * FROM `foodmenu` WHERE ID='". $_GET['ID'] ."'");
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
            <h2> Edit Menu Item</h2>
            
            <!-- shows success message when successful -->
            <?php if(isset($succuessMessage)){ echo $succuessMessage;}?>

            <!-- will send the submitted data to that file where it will be added to the database -->
            Enter Type of User: <br>
            <select name="foodCategory" required>
                <option value="1"> Main Course </option>
                <option value="2"> Dessert </option>
                <option value="3"> Appetizer </option>
                <option value="4"> Drink </option>
            </select><br><br>
        
            Enter Food Name:<br>
            <input type="text" name="foodName" value="<?php echo $row['foodName'] ?>" required><br><br>

            Enter Food Price:<br>
            <input type="number" name="foodPrice" value="<?php echo $row['foodPrice'] ?>" required><br><br>

            <input type="submit">
        </form>
    </body>
</html>