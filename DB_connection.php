<?php

    $con = new mysqli("localhost","root","","oj");

    if($con->connect_error)
    {
        die("Failed to connect to database! <br> Error:".$con->connect_error);
    }

    // echo "Connected to database successfully<br>";
    // echo "Query successful";

    $con->set_charset("utf8");
    $sql = "select * from questions";
    $result = $con->query($sql);

    $row = $result->fetch_assoc();
    
    $con->close();
?>
