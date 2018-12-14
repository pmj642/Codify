<!DOCTYPE html>

<html>
	<head>
		<title> Log-in </title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../public/stylesheets/main.css">
	</head>

	<body>

		<!-- Header -->

		<?php
            require('../public/templates/header.php');
        ?>

		<!-- Log-in -->

		<section class="row">
			<div class="container">

				<div class='centre card form-container'>

					<form method="post" action="../app/login.php">

						<?php

							if(isset($_SESSION['user_id']))
							{
								header('Location: ../public/home.php');
							}

							if(isset($_SESSION['successMsg']))
							{
								echo "<p class='reporting success'>".$_SESSION['successMsg']."</p>";
								unset($_SESSION['msg']);
							}

							if(isset($_SESSION['errorMsg']))
							{
								echo "<p class='reporting error'>".$_SESSION['errorMsg']."</p>";
								unset($_SESSION['errorMsg']);
							}
						?>

						<!-- <p class="reporting error">Username already exists!</p>
						<p class="reporting success">User created!</p> -->

						Email
						<input type="email" name="email" placeholder="Your email..." required>

						<br>Password
						<input type="password" name="pass" placeholder="Password..." required>

						<br>
						<input type="submit" value="Log-in">

					</form>

				</div>

			</div>
		</section>

		<!-- Footer -->

		<?php
            require('../public/templates/footer.php');
        ?>

	</body>
</html>
