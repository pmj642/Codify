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

            $stat = $con->prepare("select * from testcases where que_id=?");
            $stat->execute(array($questionId));

            if($stat->rowCount() == 0)
            {
                $debug .= "Testcases not found!\n";
            }
            else
            {
                $debug .= "Testcases found!\n";

                $row = $stat->fetch();

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

                $stat = $con->prepare("insert into submissions values(?,?,?,?,?)");
                $stat->execute(array($ctime,$userId,$questionId,$responseTime,$responseStatus));

                $err = $stat -> errorInfo();
                $debug .= ($err[2] . "\n");

                if($responseStatus == 'Accepted')
                {
                    // check if question previously solved

                    $stat = $con->prepare("select user_id from solved where que_id=? and user_id=?");
                    $stat->execute(array($questionId,$userId));
                    $err = $stat -> errorInfo();
                    $debug .= ($err[2] . "\n");

                    if($stat -> rowCount() == 0)
                    {
                        $stat = $con->prepare("insert into solved values(?,?)");
                        $stat->execute(array($userId,$questionId));
                        $err = $stat -> errorInfo();
                        $debug .= ($err[2] . "\n");

                        $stat = $con->prepare("select user_id from ranks where user_id=?");
                        $stat->execute(array($userId));
                        $err = $stat -> errorInfo();
                        $debug .= ($err[2] . "\n");

                        if($stat -> rowCount() == 0)
                        {
                            $stat = $con->prepare("insert into ranks values(?,?)");
                            $stat->execute(array($userId,1));
                            $err = $stat -> errorInfo();
                            $debug .= ($err[2] . "\n");
                        }
                        else
                        {
                            $stat = $con->prepare("update ranks set question_count = question_count + 1");
                            $stat->execute();
                            $err = $stat -> errorInfo();
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
