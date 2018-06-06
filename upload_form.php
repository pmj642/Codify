<!DOCTYPE html>
<html>
        <head>
            <title>Upload</title>
            <meta charset='utf-8'>
            <link rel="stylesheet" href="assets/stylesheets/main.css">
        </head>

    	<body>

    		<!-- Header -->

            <?php
                require('header.php');
            ?>

            <section class="row">
    			<div class="container">
    				<form method="post" action="">

                        Name
    					<input type="text" name="name" placeholder="Question name..." required>

    					<br>Description
    					<textarea name="description" rows="5" required>Give a detailed description of the question...
                        </textarea>

                        <br>Expected Input
    					<textarea name="inputFormat" rows="5" required>Ex. The first line contains an integer T, total number of testcases. Then follow T lines, each line contains an integer N.
                        </textarea>

                        <br>Expected Output
    					<textarea name="inputFormat" rows="5" required>Ex. Calculate the sum of digits of N.</textarea>

    					<br>
    					<input type="submit" value="Upload">

    				</form>

    			</div>
    		</section>

            <!-- Footer -->

            <?php
                require('footer.php');
            ?>

        </body>
</html>
