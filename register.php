<?php

    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $country = $_POST["country"];

    echo $name." ".$pass;
    echo "Hello";

    // $con = pg_connect(getenv("DATABASE_URL"));
    $con = new mysqli("localhost","root","","oj");

    if($con->connect_error)
    {
        die("Failed to connect to database! <br> Error:".$con->connect_error);
    }

    // echo "Connected to database successfully<br>";
    // echo "Query successful";

    $con->set_charset("utf8");

    // check for duplicate username and show error

    $sql = "select * from userlogin where user='$email'";
    $result = $con->query($sql);

    if($result->num_rows > 0)
        echo "Error!";

    // $row = $result->fetch_assoc();
    // $result = pg_query($sql);
    //
    // if($result)
    // {
    //     echo "success"
    //     // session_start();
    //     // $_SESSION["msg"] = 'Email already exists!';
    //     // header(Location: 'register_form.php');
    // }
    // else {
    //     echo "failure";
    // }
    //
    // // hash the Password
    //
    // $hashPass = password_hash($pass, PASSWORD_DEFAULT);
    // echo $hashPass;

    $con->close();
?>
