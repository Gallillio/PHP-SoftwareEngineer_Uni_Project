<!-- This file is to display the menu's data -->

<!-- connects to database -->
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
        $deleteSQL = mysqli_query($conn, "DELETE FROM `foodmenu` WHERE `ID` = '$id' ");
    }
?>

<html>
    <head></head>
    <body>
        <table border="1">
            <th>ID</th>
            <th>food name</th>
            <th>food price</th>
            <th>food category</th>
            <th>image</th>
            <th>edit</th>
            <th>delete</th>
            
            <!-- adds the data -->
            <?php
                $sql = "SELECT * FROM foodmenu";
                $result = $conn -> query($sql);

                // checks if rows are more than 0 (is there any data inside table)
                if($result -> num_rows > 0){
                    while($row = $result -> fetch_assoc()){
                        // Switches the food Category numbering into its actual Name
                        if($row["foodCategory"] == 1){
                            $foodCategoryNamed = "Main Course";
                        }
                        elseif($row["foodCategory"] == 2){
                            $foodCategoryNamed = "Dessert";
                        }
                        elseif($row["foodCategory"] == 3){
                            $foodCategoryNamed = "Appetizer";
                        }
                        elseif($row["foodCategory"] == 4){
                            $foodCategoryNamed = "Drink";
                        }
                        else{
                            $foodCategoryNamed = "Something went wrong";
                        }
                        echo "
                        <tr>
                            <td>" . $row["ID"] . "</td>
                            <td>" . $row["foodName"] . "</td>
                            <td>" . $row["foodPrice"] . "</td>
                            <td>" . $foodCategoryNamed . "</td>
                            <td> <img src='img/".$row['image'] ."' width='200'> </td>
                            <td> <a href='display-menu-data.php?ID=".$row["ID"] ."'> DELETE </a> </td>
                            <td> <a href='edit-menu-form.php?ID=".$row["ID"] ."'> Edit/Update </a> </td>
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
        Add another menu Item: <a href='add-menu-item-form.php'> Here </a>
    </body>
</html>

<?php
    #runs the close connection function
    CloseConnection($conn);
?>

