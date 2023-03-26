<!-- This file is form for the register admins and employees -->

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
        <h2> Register new Employee </h2>
        <!-- will send the submitted data to that file where it will be added to the database -->
        <form action="send-register-employee-data.php" method="post"> 
            Select Type of User: <br>
            <select name="userType" required>
                <!-- admin -> 1   /   worker -> 2 -->
                <option value="2"> Worker </option>
                <option value="1"> Administrator </option>
            </select><br><br>
        
            Enter Username:<br>
            <input type="text" name="employeeUsername" required><br><br>

            Enter Email:<br>
            <input type="email" name="employeeEmail" required><br><br>

            Enter Password:<br>
            <input type="password" name="employeePassword" required><br><br>

            Enter Age:<br>
            <input type="number" name="employeeAge" required><br><br>

            Gender:<br>
            Male <input type="radio" name="employeeGender" value="m" required> Female <input type="radio" name="employeeGender" value="f" required><br><br>

            Address:<br>
            <input type="text" name="employeeAddress" required><br><br>

            Phone Number:<br>
            <input type="number" name="employeePhone" required><br><br>            

            <input type="submit" >
        </form>
        or <br><br>
        Go to Display Employee Records: <a href="display-employee-data.php">Here</a>
    </body>
</html>