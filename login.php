<?php

    $pass = $_POST["pass"];
    $email = $_POST["email"];

    // echo $name." ".$pass."<br>";

    // $con = pg_connect(getenv("DATABASE_URL"));
    $con = new mysqli("localhost","root","","oj");

    if($con->connect_error)
    {
        die("Failed to connect to database! <br> Error:".$con->connect_error);
    }

    echo "Connected to database successfully<br>";

    session_start();

    // check for valid credentials and show error

    $sql1 = "select * from userlogin where user='$email'";
    $result = $con->query($sql1);
    $row1 = $result->fetch_assoc();

    // $hashPass = password_hash($pass, PASSWORD_DEFAULT);

    // echo $row1["pass"]."<br>".$pass;

    if(password_verify($pass,$row1["pass"]))
    {
        echo "Valid";
        $id = $row1["id"];

        $sql2 = "select * from userdetails where id='$id'";
        $result = $con->query($sql2);
        $row2 = $result->fetch_assoc();
        $con->close();

        $_SESSION["user"] = $row2["name"];
        header('Location: index.php');
    }
    else
    {
        echo "Error!<br>";
        $con->close();
        $_SESSION["msg"] = 'Incorrect credentials!';
        header('Location: login_form.php');
    }

?>
