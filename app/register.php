<?php

    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $country = $_POST["country"];

    echo $name." ".$pass."<br>";

    // $con = pg_connect(getenv("DATABASE_URL"));
    $con = new mysqli("localhost","root","","oj");

    if($con->connect_error)
    {
        die("Failed to connect to database! <br> Error:".$con->connect_error);
    }

    echo "Connected to database successfully<br>";

    $con->set_charset("utf8");

    // check for duplicate username and show error

    $sql = "select * from userlogin where user='$email'";
    $result = $con->query($sql);
    // $result = pg_query($sql);
    session_start();

    if($result->num_rows > 0)
    {
        echo "Error!<br>";
        $con->close();
        $_SESSION["errorMsg"] = 'Email already exists!';
        header('Location: ../public/register_form.php');
    }
    else
    {
        echo "Success!<br>";

        // hash the Password

        $hashPass = password_hash($pass, PASSWORD_DEFAULT);
        echo $hashPass;

        // start a transaction

        $con->begin_transaction();

        $sql1 = "insert into userlogin (user,pass) values('$email','$hashPass')";
        $q1 = $con->query($sql1);

        $sql2 = "insert into userdetails (name,age,gender,country) values('$name',$age,'$gender','$country')";
        $q2 = $con->query($sql2);

        if(!$q1 || !$q2)
        {
            $_SESSION["errorMsg"] = 'User creation failed! Try again!';
            header('Location: ../public/register_form.php');
        }
        else
        {
            $con->commit();
            $con->close();
            $_SESSION["successMsg"] = 'User created successfully!';
            header('Location: ../public/login_form.php');
            // echo "User creation successful!";
        }
    }
?>
