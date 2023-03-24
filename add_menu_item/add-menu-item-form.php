<!-- This file is to add new item to menu -->

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
        <form action="send-new-menu-item.php" method="post"> 
            Select new food type:<br>
            <select name="foodCategory" required>
                <option value="1"> Main Course </option>
                <option value="2"> Dessert </option>
                <option value="3"> Appetizer </option>
                <option value="4"> Drink </option>
            </select><br><br>
            
            Enter Food Name:<br>
            <input type="text" name="foodName" required><br><br>

            Enter Food Price:<br>
            <input type="number" name="foodPrice" required><br><br>

            <!-- Select Image:<br>
            <input type="file" name="upload" accept="image/*" required><br><br> -->
            
            <input type="submit" name="submit">
        </form>
        or<br><br>
        Go to Display Menu Items: <a href="display-menu-data.php">Here</a>
    </body>
</html>