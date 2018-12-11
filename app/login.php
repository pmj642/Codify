<?php

    $pass = $_POST["pass"];
    $email = $_POST["email"];

    // echo $name." ".$pass."<br>";

    // $con = pg_connect(getenv("DATABASE_URL"));
    // $con = new mysqli("localhost","root","","oj");
    //
    // if($con->connect_error)
    // {
    //     die("Failed to connect to database! <br> Error:".$con->connect_error);
    // }
    //
    // echo "Connected to database successfully<br>";

    $servername = "localhost";
    $username = "root";
    $password = "";

    try
    {
        $con = new PDO("mysql:host=$servername;dbname=oj", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        session_start();

        // check for valid credentials and show error

        $sql1 = "select * from userlogin where user='$email'";
        $result = $con->query($sql1);
        $row1 = $result->fetch();

        // $hashPass = password_hash($pass, PASSWORD_DEFAULT);

        // echo $row1["pass"]."<br>".$pass;

        if(password_verify($pass,$row1["pass"]))
        {
            echo "Valid";
            $id = $row1["id"];

            $sql2 = "select * from userdetails where id='$id'";
            $result = $con->query($sql2);
            $row2 = $result->fetch();
            // $con->close();
            $con = null;

            $_SESSION["user_name"] = $row2["name"];
            $_SESSION["user_id"] = $row2["id"];

            header('Location: ../public/home.php');
        }
        else
        {
            echo "Error!<br>";
            // $con->close();
            $con = null;

            $_SESSION["errorMsg"] = 'Incorrect credentials!';

            header('Location: ../public/login_form.php');
        }
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
        $con = null;
    }

?>
