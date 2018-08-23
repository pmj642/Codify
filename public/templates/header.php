<?php
    if(!isset($_SESSION))
        session_start();
?>

<header id="header" class="container group">

    <h1 class="logo">
        <a href="index.php">Codify</a>
    </h1>

    <h3 class="login-status">

        <!-- whether user is logged in or not -->

        <?php

            if(isset($_SESSION['user']))
            {
                echo "Hey, ".$_SESSION['user']." | ";
                echo "<a href='logout.php' class='nav primary-nav'> Log-out </a>";
            }
            else
            {
                echo "<a href='login_form.php'>Log-in</a>";
                echo " | ";
                echo "<a href='register_form.php'>Register</a>";
            }

        ?>

    </h3>

    <nav class="nav primary-nav">
        <ul>
            <li>    <a href="index.php">Home</a>   </li><!--
            --><li>    <a href="practice.php">Practice</a>   </li><!--
            --><li>    <a href="rankings.html">Rankings</a>   </li><!--
            --><li>    <a href="ide.php">IDE</a>   </li>
        </ul>
    </nav>

</heaDEr>