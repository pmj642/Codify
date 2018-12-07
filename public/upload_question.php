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

        					<br>Description
        					<textarea name="description" rows="5" required>Give a detailed description of the question...
                            </textarea>

                            <br>InputFormat
        					<textarea name="inputformat" rows="5" required>The input to the program...
                            </textarea>

                            <br>OutputFormat
        					<textarea name="outputformat" rows="5" required>The output to the program...
                            </textarea>

                            <br>Constraints
        					<textarea name="contraints" rows="5" required>Memory and time Constraints
                            </textarea>

                            <br>Example Input
        					<textarea name="examplein" rows="5" required>Example Input
                            </textarea>

                            <br>Example Output
        					<textarea name="exampleout" rows="5" required>Example Output
                            </textarea>

                            <br>Input Testcases
        					<textarea name="inputtest" rows="5" required>Input Testcases
                            </textarea>

                            <br>Output Testcases
        					<textarea name="outputtest" rows="5" required>Output Testcases
                            </textarea>

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
