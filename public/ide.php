<!DOCTYPE html>
<html>
        <head>
            <title>IDE</title>
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

                <section class="col-1-3">

                    <div class="card submit-box black-heading">
                        File
                        <input type="file" id="solution">

                        <br>Input
    					<textarea id="stdin" rows="5" required></textarea>

                        <br>Expected Output
    					<textarea id="stdout" rows="5"></textarea>

                        <br>Language
                        <select id="fileType">
                            <option>C++</option>
                            <option>Java</option>
                        </select>

                        <a class="btn btn-default" onclick="submit()">Submit</a>
                    </div>

                </section><!--

                    Result

                --><section class="col-1-3">

                    <div class="card result-box black-heading" style="margin-top: 0">
                        <div class="result-div centre" id="verdict">

                        </div><!--

                        Verdict

                        --><div class="result-div centre" id="result">

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
