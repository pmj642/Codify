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
              if(!isset($_SESSION['user_id']))
              {
                  echo "<a class='btn btn-alt' href='../public/register_form.php'>Register Now</a>";
              }
        ?>

        </section>

        <!-- Teasers -->

        <section class="row">
          <div class="grid">

            <!-- Leaderboard -->

            <section class="teaser col-1-3">

              <div class="teaser-div card">
                    <h2>Leaderboard</h2>
                    <p>See where you stand among your friends.
                        After all competition is good for your brain!</p>

                    <div class="centre-wrapper">
                        <a class="btn btn-default" href="../public/rankings.php">
                            Rankings
                        </a>
                    </div>
              </div>

            </section><!--

            Practice

            --><section class="teaser col-1-3">

              <div class="teaser-div card">
                    <h2>Workout for your brain</h2>
                    <p>Everyone starts with a brute force solution.
                        But with practice you will rise above arrays!</p>

                    <div class="centre-wrapper">
                        <a class="btn btn-default" href="../public/practice.php">
                            Practice
                        </a>
                    </div>
              </div>

            </section><!--

            Codify IDE

            --><section class="teaser col-1-3">

              <div class="teaser-div card">
                    <h2>Test your code</h2>
                    <p>The Codify IDE lets you to run your code with
                        input and displays the result!</p>

                    <div class="centre-wrapper">
                        <a class="btn btn-default" href="../public/IDE.php">
                            Codify IDE
                        </a>
                    </div>
              </div>

            </section>

          </div>
        </section>

        <?php
            require('../public/templates/footer.php');
        ?>

    </body>

</html>
