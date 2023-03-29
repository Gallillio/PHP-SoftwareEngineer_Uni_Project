<!-- This file is to add new item to menu -->

<!-- connects to database -->
<?php
    #file that has db connection
    include "../db-connection.php";
    
    #runs the open connection function
    $conn = OpenConnection();
    // echo "Connected Successfully";
    echo "<script>console.log('Database Connected Successful');</script>";
?>

<!-- This php section is the process to add the new menu item to the database -->
<?php
    if(isset($_POST["submit"])){
        $foodName = $_POST["foodName"];
        $foodPrice = $_POST["foodPrice"];
        $foodCategory = $_POST["foodCategory"];
        if($_FILES["image"]["error"] == 4){
            echo
            "<script> alert('Image Does Not Exist'); </script>"
            ;
        }
        else{
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];
        
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if ( !in_array($imageExtension, $validImageExtension) ){
                echo
                "
                <script>
                alert('Invalid Image Extension');
                </script>
                ";
            }
            else if($fileSize > 1000000){
                echo
                "
                <script>
                alert('Image Size Is Too Large');
                </script>
                ";
            }
            else{
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;
        
                move_uploaded_file($tmpName, 'img/' . $newImageName);
                $query = "INSERT INTO foodmenu VALUES('', '$foodName', '$foodPrice', '$foodCategory', '$newImageName')";
                mysqli_query($conn, $query);
                echo
                "
                <script>
                alert('Successfully Added');
                document.location.href = 'display-menu-data.php';
                </script>
                ";
            }
        }
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
        <h2> Add new Item </h2>
        <!-- will send the submitted data to that file where it will be added to the database -->
        <form method="post" autocomplete="off" enctype="multipart/form-data"> 
            Select new food type:<br>
            <select name="foodCategory" required>
                <option value="1"> Main Course </option>
                <option value="2"> Dessert </option>
                <option value="3"> Appetizer </option>
                <option value="4"> Drink </option>
            </select><br><br>
            
            Enter Food Name:<br>
            <input type="text" name="foodName" id="foodName"required><br><br>

            Enter Food Price:<br>
            <input type="number" name="foodPrice" id="foodPrice" required><br><br>

            Select Image:<br>
            <input type="file" name="image" id="image" accept="image/*" required><br><br>
            
            <input type="submit" name="submit">
        </form>
        or<br><br>
        Go to Display Menu Items: <a href="display-menu-data.php">Here</a>
    </body>
</html>

<?php
    #runs the close connection function
    CloseConnection($conn);
?>