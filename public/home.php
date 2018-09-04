<!DOCTYPE html>

<html>

    <head>
        <title>Home</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../public/stylesheets/main.css">
    </head>

    <body>

        <!-- Header -->

        <?php
            require('../public/templates/header.php');
        ?>

        <!-- Hero -->

        <section class="hero container">

          <h2>Learn => Code => Master</h2>

          <p>Code is not something which you write on paper! <br>
              It is to be run on a machine!</p>

        <?php
              if(!isset($_SESSION['user']))
              {
                  echo "<a class='btn btn-alt' href='../public/register_form.php'>Register Now</a>";
              }
        ?>

        </section>

        <!-- Teasers -->

        <section class="row">
          <div class="grid">

            <!-- Register -->

            <section class="teaser col-1-3">

              <a href="../public/rankings.html">
                <h2>Leaderboard</h2>
                <p>See where you stand among your friends.
                    After all competition is good for your brain!</p>
                <a class="btn btn-default" href="../public/rankings.html">Rankings</a>
              </a>

            </section><!--

            Practice

            --><section class="teaser col-1-3">

              <a href="../public/practice.php">
                <h2>Workout for your brain</h2>
                <p>Everyone starts with a brute force solution.
                    But with practice you will rise above arrays!</p>
                <a class="btn btn-default" href="../public/practice.php">Practice</a>
              </a>

            </section><!--

            About Us

            --><section class="teaser col-1-3">

              <a href="../public/IDE.php">
                <h2>Test your code</h2>
                <p>The Codify IDE lets you to submit your code,
                    provide input to the code and displays the result!</p>
                <a class="btn btn-default" href="../public/IDE.php">Codify IDE</a>
              </a>

            </section>

          </div>
        </section>

        <?php
            require('../public/templates/footer.php');
        ?>

    </body>

</html>
