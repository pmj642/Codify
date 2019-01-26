<?php
    if(!isset($_GET["id"]))
    {
        http_response_code(404);
        include('../public/templates/404.php');
        die();
    }
?>

<!DOCTYPE html>
<html>
        <head>
            <title></title>
            <meta charset='utf-8'>
            <link rel="stylesheet" href="../public/stylesheets/main.css">
            <script type="text/javascript" src="../public/scripts/submit_server.js">
            </script>
        </head>

    	<body>

    		<!-- Header -->

            <?php
                require('../public/templates/header.php');
            ?>

            <section class="row">
              <div class="grid">

                <!-- Question -->

                <section class="col-2-3">

                    <!-- script to fetch the question list -->

                    <?php

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
                                        ));$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stat = $con -> prepare("select * from questions where que_id=?");
                            $stat->execute(array($_GET["id"]));

                            $row = $stat->fetch();
                            // $row = $result->fetch_assoc();

                            echo "<div class='black-heading question card'>";
                            echo "<h1>".$row["name"]."</h1>";
                            echo "<p>".$row["description"]."</p>";

                            echo "<h2>Input</h2>";
                            echo "<p>".$row["inputformat"]."</p>";

                            echo "<h2>Output</h2>";
                            echo "<p>".$row["outputformat"]."</p>";

                            echo "<h2>Constraints</h2>";
                            echo "<p>".nl2br($row["constraints"])."</p>";

                            echo "<h2>Example</h2>";
                            echo "<h3>Input</h3>";
                            echo "<p>".nl2br($row["examplein"])."</p>";
                            echo "<h3>Output</h3>";
                            echo "<p>".nl2br($row["exampleout"])."</p>";
                            echo "</div>";
                        }
                        catch(PDOException $e)
                        {
                            echo $e->getMessage() ."\n";
                        }

                        $con = null;

                    ?>

                </section><!--

                Submit

            --><section class="col-1-3">

                    <?php

                        if(!$_SESSION['user_id'])
                        {
                            echo "<p class='reporting error' style='margin: 0% 5%; width: 90%;'>".
                                     "Login to submit solutions!".
                                 "</p>";
                        }
                        else
                        {
                            echo "<div class='card submit-box'>
                                File
                                <input type='file' id='solution'>

                                <br>Language
                                <select id='fileType'>
                                    <option>C++</option>
                                    <option>Java</option>
                                </select>

                                <a class='btn btn-default' onclick='submit()'>Submit</a>
                            </div>

                            <div class='card result-box black-heading'>
                                <div class='result-div centre' id='verdict'>

                                </div><!--

                                Verdict

                            --><div class='result-div centre' id='result'>

                                </div>
                            </div>";
                        }
                    ?>

                </section>

              </div>
            </section>

            <!-- Footer -->

            <?php
                require('../public/templates/footer.php');
            ?>

        </body>
</html>
