<?php

    $pass = $_POST["pass"];
    $email = $_POST["email"];

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

        session_start();

        // check for valid credentials and show error

        $stat = $con->prepare("select * from userlogin where username=?");
        $stat->execute(array($email));
        $row1 = $stat->fetch();

        // $hashPass = password_hash($pass, PASSWORD_DEFAULT);

        // echo $row1["pass"]."<br>".$pass;

        if(password_verify($pass,$row1["pass"]))
        {
            echo "Valid";
            $id = $row1["user_id"];

            $stat = $con->prepare("select * from userdetails where user_id=?");
            $stat->execute(array($id));
            $row2 = $stat->fetch();
            // $con->close();
            $con = null;

            $_SESSION["user_name"] = $row2["name"];
            $_SESSION["user_id"] = $row2["user_id"];

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
        echo $e->getMessage() . "\n";
        $con = null;
    }

?>
