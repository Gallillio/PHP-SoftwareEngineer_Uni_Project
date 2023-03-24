<?php
    #opens connection
    function OpenConnection()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "restaurantmanagment";

        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
        
        return $conn;
    }

    #closes connection
    function CloseConnection($conn)
    {
        $conn -> close();
    }


?>