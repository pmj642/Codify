<?php

    require '../vendor/autoload.php';
    use GuzzleHttp\Client;

    //  check if user has logged in

    if(!isset($_SESSION))
        session_start();

    if(isset($_SESSION["user_id"]))
    {
        $userId = $_SESSION["user_id"];

        $req = file_get_contents('php://input');
        $req = json_decode($req);

        $questionId = $req->question_id;

        $responseObj = [];
        $debug = "";

        // get testcases from database

        // $con = new mysqli("localhost","root","","oj");
        //
        // if($con->connect_error)
        // {
        //     die("Failed to connect to database! <br> Error:".$con->connect_error);
        // }

        $servername = "localhost";
        $username = "root";
        $password = "";

        try
        {
            $con = new PDO("mysql:host=$servername;dbname=oj", $username, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "select * from testcases where que_id='$questionId'";

            $result = $con->query($sql);

            if($result->rowCount() == 0)
            {
                $debug .= "Testcases not found!\n";
            }
            else
            {
                $debug .= "Testcases found!\n";

                $row = $result->fetch();

                $input = $row["input"];
                $output = $row["output"];

                date_default_timezone_set('UTC');
                $ctime = date('Y/m/d H:i:s');

                header('Content-type: application/json');

                $apiUrl = "https://api.judge0.com/submissions/?base64_encoded=false&wait=true";

                $client = new Client(['base_uri' => $apiUrl]);

                $result = $client -> request('POST', $apiUrl, ['json' => [
                    'source_code' => $req->source_code,
                    'language_id' => $req->language_id,
                    'stdin' => $input,
                    'expected_output' => $output
                ]]);

                $debug .= "THIS IS RESULT\n";
                $debug .= $result->getStatusCode() . "\n";

                $response = json_decode($result->getBody());

                $debug .= $response->time . "\n";
                $debug .= $response->status->description . "\n";
                $debug .= $ctime . "\n";
                $debug .= $_SESSION["user_id"] . "\n";

                // make submission entry in database

                $responseTime = $response->time;
                $responseStatus = $response->status->description;

                $responseObj['time'] = $responseTime;
                $responseObj['memory'] = $response->memory;
                $responseObj['stdout'] = $response->stdout;
                $responseObj['status'] = $response->status;

                $sql = "insert into submissions values(
                        '$ctime','$userId','$questionId','$responseTime','$responseStatus')";

                $result = $con->query($sql);

                $err = $con -> errorInfo();
                $debug .= ($err[2] . "\n");

                if($responseStatus == 'Accepted')
                {
                    // check if question previously solved

                    $sql = "select user_id from solved where que_id='$questionId' and user_id='$userId'";
                    $result = $con->query($sql);
                    $err = $con -> errorInfo();
                    $debug .= ($err[2] . "\n");

                    if($result -> rowCount() == 0)
                    {
                        $sql = "insert into solved values('$userId','$questionId')";
                        $result = $con->query($sql);
                        $err = $con -> errorInfo();
                        $debug .= ($err[2] . "\n");

                        $sql = "select user_id from ranks where user_id='$userId'";
                        $result = $con->query($sql);
                        $err = $con -> errorInfo();
                        $debug .= ($err[2] . "\n");

                        if($result -> rowCount() == 0)
                        {
                            $sql = "insert into ranks values('$userId','1')";
                            $result = $con->query($sql);
                            $err = $con -> errorInfo();
                            $debug .= ($err[2] . "\n");
                        }
                        else
                        {
                            $sql = "update ranks set question_count = question_count + 1";
                            $result = $con->query($sql);
                            $err = $con -> errorInfo();
                            $debug .= ($err[2] . "\n");
                        }
                    }

                }

                if($result)
                    $debug .= "Succesful database entry!<br>";
                else
                    $debug .= "Failed database entry!<br>";

                $responseObj['debug'] = $debug;

                $responseObj = json_encode((object) $responseObj);
                echo $responseObj;
            }
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }

        $con = null;
    }
    else
    {
        echo "You need to login!";
    }

?>
