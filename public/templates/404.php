<!DOCTYPE html>
<html>
        <head>
            <title>Page not found</title>
            <meta charset='utf-8'>
            <link rel="stylesheet" href="/public/stylesheets/main.css">
        </head>

    	<body>

    		<!-- Header -->

            <?php
                require('/public/templates/header.php');
            ?>

            <section class="row">
              <div class="grid">

                <!-- Message -->

                <section class="card black-heading not-found">

                    <h1>404</h1>

                    <br>
                    <h2>Page not found</h2>

                    <img src='/public/images/broken-link.png'>

                </section>

              </div>
            </section>

            <!-- Footer -->

            <?php
                require('/public/templates/footer.php');
            ?>

        </body>
</html>
