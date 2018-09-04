<?php

        session_start();
        session_destroy();

        $r = $_SERVER['HTTP_REFERER'];

        if(isset($r))
            header('Location: '.$r);
        else
            header('Location: ../public/home.php');

?>
