<?php

    $name = $_POST["name"];
    $description = $_POST["description"];
    $inputformat = $_POST["inputformat"];
    $outputformat = $_POST["outputformat"];
    $constraints = $_POST["contraints"];
    $examplein = $_POST["examplein"];
    $exampleout = $_POST["exampleout"];
    $inputtest = $_POST["inputtest"];
    $outputtest = $_POST["outputtest"];

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

        // start a transaction

        $con->beginTransaction();

        $stat = $con->prepare("insert into questions (name, description, inputFormat, outputformat,
        constraints, exampleIn, exampleOut) values(?,?,?,?,?,?,?)");
        $stat->execute(array($name,$description,$inputformat,
        $outputformat,$constraints,$examplein,$exampleout));
        // $result = pg_query($sql);

        $ai = $con -> lastInsertId();

        // inserted or not

        if($ai)
        {
            $stat = $con->prepare("insert into testcases (que_id, input, output) values(?,?,?)");
            $stat->execute(array($ai,$inputtest,$outputtest));
            // $result = pg_query($sql);

            if(!$stat)
            {
                // testcase insert Failed show error

                // can we add functionality to redirect to question upload page
                // with the question info filled in
                $_SESSION["errorMsg"] = 'Question upload failed! Try again!';
            }
            else
            {
                $_SESSION["successMsg"] = 'Question uploaded successfully!';
                $con->commit();
            }

            $con = null;
            header('Location: ../public/practice.php');
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage() . "\n";
    }

    $con = null;
?>
