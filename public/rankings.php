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
                                        ));
                            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // obtain names and user_ids in an assoc array

                            $sql = "select user_id,name from userdetails";
                            $result = $con->query($sql);

                            while($row = $result->fetch())
                            {
                                $idToName[$row['user_id']] = $row['name'];
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

                            while($row = $result->fetch())
                            {
                                ++$i;

                                echo "<tr>";
                                echo    "<td> $i </td>";
                                echo    "<td>" . $idToName[$row['user_id']] . "</td>";
                                echo    "<td>" . $row['question_count'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";
                        }
                        catch(PDOException $e)
                        {
                            echo $sql . "<br>" . $e->getMessage();
                        }

                        $conn = null;

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
