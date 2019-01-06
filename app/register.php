<?php

    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $country = $_POST["country"];

    echo $name." ".$pass."<br>";

    $db = parse_url(getenv("DATABASE_URL"));

    try
    {
        $con = new PDO("pgsql:" . sprintf(
                        "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                        $db["host"],
                        $db["port"],
                        $db["user"],
                        $db["pass"],
                        ltrim($db["path"], "/")
                    ));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // check for duplicate username and show error

        $stat = $con->prepare("select * from userlogin where username=?");
        $stat->execute(array($email));

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
            echo $hashPass . "<br>";

            // start a transaction

            $con->beginTransaction();

            $stat = $con->prepare("insert into userdetails (name,age,gender,country) values(?,?,?,?)");
            $stat->execute(array($name,$age,$gender,$country));

            $ai = $con->lastInsertId();
            echo "AI=" . $ai . "<br>";

            if($ai)
            {
                $stat = $con->prepare("insert into userlogin (user_id,username,pass) values(?,?,?)");
                $stat->execute(array($ai,$email,$hashPass));

                echo "STAT=" . $stat1 . " " . $stat2 . "<br>";

                if(!$stat)
                {
                    $err = $stat->errorInfo();
                    $_SESSION["errorMsg"] = $err[2] . 'User creation failed! Try again!';
                    $con->rollback();
                    header('Location: ../public/register_form.php');
                }
                else
                {
                    $con->commit();
                    $con = null;
                    $_SESSION["successMsg"] = 'User created successfully!';
                    header('Location: ../public/login_form.php');
                }
            }
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage() . "\n";
    }

    $con = null;
?>
