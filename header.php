<header id="header" class="container group">

    <h1 class="logo">
        <a href="index.html">Codify</a>
    </h1>

    <h3 class="login-status">

        <!-- whether user is logged in or not -->

        <?php
                session_start();

                if(isset($_SESSION['user']))
                {
                    echo "Hey, ".$_SESSION['user'];
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
            <li>    <a href="index.html">Home</a>   </li><!--
            --><li>    <a href="question.php">Practice</a>   </li><!--
            --><li>    <a href="register_form.php">Register</a>   </li><!--
            --><li>    <a href="rankings.html">Rankings</a>   </li><!--
            --><li>    <a href="execute.html">Execute</a>   </li>
        </ul>
    </nav>

</header>
