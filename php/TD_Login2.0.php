<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>L A G - TD Login 2.0</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png">
		<link rel="stylesheet" type="text/css" href="../css/login.css">
	</head>
	<body>

		<header>
			<div id="hTitle">school</div>
			<a href="../index.php"><div id="hLink">Back to index</div></a>
		</header>

		<!-- PHP -->
		<?php

			session_start();

			// --- SETUP BDD ---

			include "./TD_school_database.php";
			$conn = ConnectDatabase();
			$logPwd = GetLoginPassword($conn);
			$loggedUser;

			// --- TREATMENT ---

			if (isset($_SESSION['login']))
				header("Location: ./TD_Authentified2.0.php");

			if (sizeof($_POST) != 0){ // If there is informations in $_POST
				if ($_POST["typeForm"] == "login"){ // If we are LOGGING IN

					$login = $_POST["login"];
					$password = $_POST["password"];

					foreach ($logPwd as $user)
						if ($login == $user['LOGIN'] && $password == $user['PASSWORD'])
							$loggedUser = $user['LOGIN'];
					if ($loggedUser != null){
						$_SESSION['login'] = $loggedUser;
						header("Location: ./TD_Authentified2.0.php");
					}
					else
						header("Location: ./TD_login2.0.php?erreur=1");

				} else if ($_POST["typeForm"] == "register"){ // If we are REGESTERING
					
					$login = $_POST["login"];
					$password = $_POST["password"];
					$confirmPassword = $_POST["confirmPassword"];
					$firstname = $_POST["firstname"];
					$lastname = $_POST["lastname"];
					// In default case, the registered user is a student

					// Verify if login is unique
					$isUnique = true;
					foreach ($logPwd as $user)
						if ($user['LOGIN'] == $login)
							$isUnique = false;

					if ($isUnique && $password == $confirmPassword && strcspn($password, '0123456789') != strlen($password)){
						// Passwords ok & login unique
						AddUser($conn, $login, $password, $lastname, $firstname);
						echo "<script>alert('You are succesfully registered. Please log you in.');</script>";
					} else {
						// Passwords not ok
						header("Location: ./TD_login2.0.php?erreur=0");
					}
				}
			}
		?>

		<div id="content" class="flex">

			<!-- LOGIN FORM -->
			<div id="loginPanel" class="flex">
				<h1 class="title">Login to school</h1>
				<form id="loginForm" class="flex panel" method="post">
					<h5 id="loginInvalid">Invalid login or password</h5>
					<input type="text" name="typeForm" value="login" hidden>

					<input type="text" id="login" name="login" placeholder="Login" required>
					<input type="password" id="password" name="password" placeholder="Password" required>

					<div class="buttons">
						<input type="reset" name="reset" id="reset" value="Reset">
						<input type="submit" name="submit" id="submit" value="Submit">
					</div>
				</form>
			</div>

			<!-- REGISTER FORM -->
			<div id="registerPanel" class="flex" style="display: none;">
				<h1 class="title">Register to school</h1>
				<form id="registerForm" class="flex panel" method="post">
					<h5 id="registerInvalid">Invalid informations</h5>
					<input type="text" name="typeForm" value="register" hidden>

					<input type="text" id="login" name="login" placeholder="Login" required min="3">
					<input type="text" id="firstname" name="firstname" placeholder="Firstname" required min="3">
					<input type="text" id="lastname" name="lastname" placeholder="Lastname" required min="3">
					<div class="subtitle">Your password may contain at least 8 character including a number.</div>
					<input type="password" id="password" name="password" placeholder="Password" required min="8">
					<input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required min="8">

					<div class="buttons">
						<input type="reset" name="reset" id="reset" value="Reset">
						<input type="submit" name="submit" id="submit" value="Submit">
					</div>
				</form>
			</div>

			<input type="button" id="switchFormButton" href="" onclick="SwitchForm()" value="Create account">

		</div>
		
		<script type="text/javascript">
			
			// Switch forms
			function SwitchForm(){
				var loginPanel = document.getElementById("loginPanel");
				var registerPanel = document.getElementById("registerPanel");
				var switchFormButton = document.getElementById("switchFormButton");

				if (loginPanel.style.display == "none"){
					// Set to login
					loginPanel.style.display = "flex";
					registerPanel.style.display = "none";
					switchFormButton.value = "Create account";
				} else {
					// Set to register
					loginPanel.style.display = "none";
					registerPanel.style.display = "flex";
					switchFormButton.value = "I have an account";
				}
			}

		</script>

		<!-- PHP ERROR -->
		<?php
			if (isset($_GET["erreur"])){
				if ($_GET["erreur"] == 0){
					echo "
						<script>
							SwitchForm();
							document.getElementById('registerInvalid').style.display = 'block';
						</script>
					";
				} else if ($_GET["erreur"] == 1){
					echo "
						<script>
							document.getElementById('loginInvalid').style.display = 'block';
						</script>
					";
				}
			}
		?>

	</body>
</html>