<!-- This file is the login page, goes and validates email and pass inputed, and then goes to the appropriate page depending on the userType -->

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
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login</title>
    </head>
    <body>
        <header>
            <h3> Login </h3>
        </header>
        <form action="validate-login.php" method="post">
            Enter your Email: <input type="email" name="inputtedEmail" required>
            <br>
            Enter your Password: <input type="password" name="inputtedPassword" required><br><br>
            <input type="submit">
        </form>
        or<br>
        <a href="index.php">Return to Index</a>
    </body>
</html>