<!DOCTYPE html>
<html>
        <head>
            <title>Practice</title>
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

                        // show message for question

                        if(isset($_SESSION['successMsg']))
                        {
                            echo "<p class='reporting success' style='margin-left: 40px'>".$_SESSION['successMsg']."</p>";
                            unset($_SESSION['msg']);
                        }

                        if(isset($_SESSION['errorMsg']))
                        {
                            echo "<p class='reporting error' style='margin-left: 40px'>".$_SESSION['errorMsg']."</p>";
                            unset($_SESSION['errorMsg']);
                        }

                        // $con = pg_connect(getenv("DATABASE_URL"));
                        $con = new mysqli("localhost","root","","oj");

                        if($con->connect_error)
                        {
                            die("Failed to connect to database! <br> Error:".$con->connect_error);
                        }

                        // echo "Connected to database successfully<br>";

                        // check for valid credentials and show error

                        $sql = "select * from questions";
                        $result = $con->query($sql);

                        echo "<table>";
                        echo "<tr>";
                        echo "<th>Name</th>";
                        echo "<th>TBD</th>";
                        echo "<th>TBD</th>";
                        echo "</tr>";

                        while($row = $result->fetch_assoc())
                        {
                            echo "<tr>";
                                echo "<td>";
                                    echo "<a href='../app/question.php?id=".$row["id"]."'>";
                                        echo $row["name"];
                                    echo "</a>";
                                echo "</td>";
                                echo "<td>TBD</td>";
                                echo "<td>TBD</td>";
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
