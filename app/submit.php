<?php
    require '../vendor/autoload.php' ;

    $req = file_get_contents('php://input');
    $req = json_decode($req);

    header('Content-type: application/json');
    // echo "THIS IS REQUEST\n";
    // echo $req;

    $apiUrl = "https://api.judge0.com/submissions/?base64_encoded=false&wait=true";

    use GuzzleHttp\Client;

    $client = new Client(['base_uri' => $apiUrl]);

    // echo "source_code"." ".$req->{'source_code'};
    // echo "language_id"." ".$req->{'language_id'};

    $result = $client -> request('POST', $apiUrl, ['json' => [
        'source_code' => $req->{'source_code'},
        'language_id' => $req->{'language_id'}
    ]]);

    echo "THIS IS RESULT\n";
    echo $result->getStatusCode();
    echo $result->getBody();
?>
