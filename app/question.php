<?php
    if(!isset($_GET["id"]))
    {
        // echo "ERROR!";
        http_response_code(404);
        include('../public/templates/404.php'); // provide your own HTML for the error page
        die();
    }
?>

<!DOCTYPE html>
<html>
        <head>
            <title></title>
            <meta charset='utf-8'>
            <link rel="stylesheet" href="../public/stylesheets/main.css">
            <script type="text/javascript" src="../public/scripts/submission_api.js">
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

                        // $con = pg_connect(getenv("DATABASE_URL"));
                        $con = new mysqli("localhost","root","","oj");

                        if($con->connect_error)
                        {
                            die("Failed to connect to database! <br> Error:".$con->connect_error);
                        }

                        $sql = "select * from questions where id=".htmlspecialchars($_GET["id"]);
                        $result = $con->query($sql);

                        // $con->set_charset("utf8");
                        // echo pg_client_encoding($con);
                        // pg_set_client_encoding($con, "UNICODE");
                        // $sql = "select * from question";
                        // $result = pg_query($sql);
                        // echo "Query successful<br>";

                        // $row = pg_fetch_assoc($result);

                        $row = $result->fetch_assoc();

                        echo "<div class='black-heading question card'>";
                        echo "<h1>".$row["name"]."</h1>";
                        echo "<p>".$row["description"]."</p>";

                        echo "<h2>Input</h2>";
                        echo "<p>".$row["inputFormat"]."</p>";

                        echo "<h2>Output</h2>";
                        echo "<p>".$row["outputFormat"]."</p>";

                        echo "<h2>Constraints</h2>";
                        echo "<p>".nl2br($row["constraints"])."</p>";

                        echo "<h2>Example</h2>";
                        echo "<h3>Input</h3>";
                        echo "<p>".nl2br($row["exampleIn"])."</p>";
                        echo "<h3>Output</h3>";
                        echo "<p>".nl2br($row["exampleOut"])."</p>";
                        echo "</div>";

                        $con->close();
                        // pg_close($con);
                        // echo "Closing Connection!";
                    ?>
                    <!-- </div> -->
                </section><!--

                Submit

            --><section class="col-1-3 card submit-box" style="margin-left: 0;">

                    <div>
                        File
                        <input type="file" id="solution">

                        <br>Language
                        <select id="fileType">
                            <option>C++</option>
                            <option>Java</option>
                        </select>

                        <a class="btn btn-default" onclick="submit()">Submit</a>
                    </div>

                </section>
              </div>
            </section>

            <!-- Footer -->

            <?php
                require('../public/templates/footer.php');
            ?>

        </body>
</html>
