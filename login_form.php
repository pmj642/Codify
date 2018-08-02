<!DOCTYPE html>

<html>
	<head>
		<title> Log-in </title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/stylesheets/main.css">
	</head>

	<body>

		<!-- Header -->

		<?php
            require('header.php');
        ?>

		<!-- Log-in -->

		<section class="row">
			<div class="container">
				<form method="post" action="login.php">

					<?php

						if(isset($_SESSION['user']))
						{
							header('Location: index.php');
						}

						if(isset($_SESSION['successMsg']))
						{
							echo "<p class='reporting success'>".$_SESSION['successMsg']."</p>";
							unset($_SESSION['msg']);
						}

						if(isset($_SESSION['errorMsg']))
						{
							echo "<p class='reporting success'>".$_SESSION['errorMsg']."</p>";
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
		</section>

		<!-- Footer -->

		<?php
            require('footer.php');
        ?>

	</body>
</html>
