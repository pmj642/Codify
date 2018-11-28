<!DOCTYPE html>
<html>
        <head>
            <title>Rankings</title>
            <meta charset='utf-8'>
            <link rel="stylesheet" href="../public/stylesheets/main.css">
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

                        // obtain names and user_ids in an assoc array

                        $sql = "select id,name from userdetails";
                        $result = $con->query($sql);

                        while($row = $result->fetch_assoc())
                        {
                            $idToName[$row['id']] = $row['name'];
                            // echo $idToName[$id];
                        }

                        echo "<table>";
                        echo    "<tr>";
                        echo        "<th></th>";
                        echo        "<th>Name</th>";
                        echo        "<th>Problems Solved</th>";
                        echo    "</tr>";

                        $sql = "select * from ranks";
                        $result = $con->query($sql);
                        $i = 0;

                        while($row = $result->fetch_assoc())
                        {
                            ++$i;

                            echo "<tr>";
                            echo    "<td> $i </td>";
                            echo    "<td>" . $idToName[$row['user_id']] . "</td>";
                            echo    "<td>" . $row['question_count'] . "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    ?>

                    <!-- </div> -->
                </section>

              </div>
            </section>

            <!-- Footer -->

            <?php
                require('../public/templates/footer.php');
            ?>

        </body>
</html>
