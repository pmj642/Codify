<!DOCTYPE html>
<html>
        <head>
            <title>Upload</title>
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

                <section class="col-2-3">
                    <div class='black-heading question card'>

                        <h1>Upload a question</h1>

        				<form method="post" action="../app/upload.php">

                            Name
        					<input type="text" name="name" placeholder="Question name..." required>

        					<br>Description of the question
        					<textarea name="description" rows="5" required></textarea>

                            <br>Input Format (What will be the input to the program?)
        					<textarea name="inputformat" rows="5" required></textarea>

                            <br>Output Format (What should be the output of the program?)
        					<textarea name="outputformat" rows="5" required></textarea>

                            <br>Memory and Time constraints (if any)
        					<textarea name="contraints" rows="5" required></textarea>

                            <br>Example Input
        					<textarea name="examplein" rows="5" required></textarea>

                            <br>Example Output
        					<textarea name="exampleout" rows="5" required></textarea>

                            <br>Testcase Input (These will be feeded to the program)
        					<textarea name="inputtest" rows="5" required></textarea>

                            <br>Testcase Output (To check the program output)
        					<textarea name="outputtest" rows="5" required></textarea>

        					<br>
        					<input type="Submit" name="upload" value="Upload">

        				</form>

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
