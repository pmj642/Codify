<?php
    $req = file_get_contents('php://input');

    header('Content-type: application/json');
    echo $req;
?>
