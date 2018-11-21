<?php

    require '../vendor/autoload.php';
    use GuzzleHttp\Client;

    //  check if user has logged in

    if(!isset($_SESSION))
        session_start();

    if(isset($_SESSION["user_id"]))
    {
        $userId = $_SESSION["user_id"];

        date_default_timezone_set('UTC');
        $ctime = date('Y/m/d H:i:s');

        $req = file_get_contents('php://input');
        $req = json_decode($req);

        header('Content-type: application/json');

        $apiUrl = "https://api.judge0.com/submissions/?base64_encoded=false&wait=true";

        $client = new Client(['base_uri' => $apiUrl]);

        $result = $client -> request('POST', $apiUrl, ['json' => [
            'source_code' => $req->source_code,
            'language_id' => $req->language_id
        ]]);

        echo "THIS IS RESULT\n";
        echo $result->getStatusCode() . "\n";

        $response = json_decode($result->getBody());

        echo $response->time . "\n";
        echo $response->status->description . "\n";
        echo $ctime . "\n";
        echo $_SESSION["user_id"] . "\n";

        // make submission entry in database

        $con = new mysqli("localhost","root","","oj");

        if($con->connect_error)
        {
            die("Failed to connect to database! <br> Error:".$con->connect_error);
        }

        $responseTime = $response->time;
        $responseStatus = $response->status->description;
        $questionId = $req->question_id;

        $sql = "insert into submissions values(
                '$ctime','$userId','$questionId','$responseTime','$responseStatus')";

        echo $sql . "\n";

        $result = $con->query($sql);

        echo $con -> error . "\n";

        if($result)
            echo "Succesful submission!\n";
        else
            echo "Failed submission!\n";
    }
    else
    {
        echo "You need to login!";
    }

?>
