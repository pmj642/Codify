<?php
    require '../vendor/autoload.php' ;
    use GuzzleHttp\Client;

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

//  make submission entry in database


?>
