<?php

    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $country = $_POST["country"];

    echo $name." ".$pass."<br>";

    // $con = pg_connect(getenv("DATABASE_URL"));
    // $con = new mysqli("localhost","root","","oj");
    //
    // if($con->connect_error)
    // {
    //     die("Failed to connect to database! <br> Error:".$con->connect_error);
    // }
    //
    // echo "Connected to database successfully<br>";
    //
    // $con->set_charset("utf8");

    $servername = "localhost";
    $username = "root";
    $password = "";

    try
    {
        $con = new PDO("mysql:host=$servername;dbname=oj", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // check for duplicate username and show error

        $stat = $con->prepare("select * from userlogin where username=?");
        $stat->execute(array($email));

        // $result = pg_query($sql);
        session_start();

        if($stat->rowCount() > 0)
        {
            echo "Error!<br>";
            $con = null;
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

            $con->beginTransaction();

            $stat1 = $con->prepare("insert into userlogin (username,pass) values(?,?)");
            $stat1->execute(array($email,$hashPass));

            $stat2 = $con->prepare("insert into userdetails (name,age,gender,country) values(?,?,?,?)");
            $stat2->execute(array($name,$age,$gender,$country));

            if(!$stat1 || !$stat2)
            {
                $_SESSION["errorMsg"] = 'User creation failed! Try again!';
                header('Location: ../public/register_form.php');
            }
            else
            {
                $con->commit();
                $con = null;
                $_SESSION["successMsg"] = 'User created successfully!';
                header('Location: ../public/login_form.php');
                // echo "User creation successful!";
            }
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage() . "\n";
    }

    $con = null;
?>
