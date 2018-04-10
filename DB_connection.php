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
    // echo "Query successful<br>";

    $row = $result->fetch_assoc();
    echo "<html>
            <head>
                <title>".$row["name"]."</title>
                <meta charset='utf-8'>
            </head>
            <body>";
    // if($result->num_rows>0) {
        // while() {
            echo "name: ".$row["name"]."<br>";
            $cons = $con->real_escape_string($row["constraints"]);

            // nl - newline br - break
            echo nl2br($cons)."<br>";
            
        // }
    // }
    // else {
    //     echo "No questions fetched!";
    // }

    echo "</body></htmL>";

    $con->close();
    echo "Closing Connection!";
?>
