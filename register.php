<?php

    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $country = $_POST["country"];

    echo $name." ".$user." ".$pass;
    echo "Hello";

    $con = pg_connect(getenv("DATABASE_URL"));

    if(!$con)
    {
        // echo "Failed to connect!";
        die("Failed to connect to database!");
    }

    // check for duplicate username and show error

    $sql = "select * from userlogin where user=" + $email;
    $result = pg_query($sql);

    if(pg_num_rows($result))
    {
        // session_start();
        // $_SESSION["msg"] = 'Email already exists!';
        header(Location: 'register_form.php');
    }
    //
    // // hash the Password
    //
    // $hashPass = password_hash($pass, PASSWORD_DEFAULT);
    // echo $hashPass;
?>
