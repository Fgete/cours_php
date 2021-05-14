<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>L A G - TD Login 2.0</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png">
		<link rel="stylesheet" type="text/css" href="../css/login.css">
	</head>
	<body>

		<!-- PHP -->
		<?php

			// V2.0
			// créer un formulaire 'REGISTER' (créer un compte)
			// tester si le pwd est correct (A0*x2)
			// tester si l'utilisateur n'éxiste pas déjà en base
			// créer un formulaire 'LOGIN' (connexion) --OK

			// créer base de notes
			// rechercher par requête les notes
			// formulaire d'ajout de note dans la base (refresh)

			session_start();

			// --- SETUP BDD ---

			include "./TD_school_database.php";
			$conn = ConnectDatabase();
			$logPwd = GetLoginPassword($conn);
			$loggedUser;

			// --- TREATMENT ---

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

		<a href="../index.php"><< Retour index</a>

		<div id="content" class="flex">

			<!-- LOGIN FORM -->
			<div id="loginPanel" class="flex">
				<form id="loginForm" class="flex" method="post">
					<h1>Login</h1>
					<h5 id="loginInvalid">Invalid login or password</h5>
					<input type="text" name="typeForm" value="login" hidden>

					<label for="password">Login</label>
					<input type="text" id="login" name="login" required>
					<label for="password">Password</label>
					<input type="text" id="password" name="password" required>

					<input type="submit" name="submit" id="submit" value="Submit">
					<input type="reset" name="reset" id="reset" value="Reset">
				</form>
			</div>

			<!-- REGISTER FORM -->
			<div id="registerPanel" class="flex" style="display: none;">
				<form id="registerForm" class="flex" method="post">
					<h1>Register</h1>
					<h5 id="registerInvalid">Invalid informations</h5>
					<input type="text" name="typeForm" value="register" hidden>

					<label for="login">Login</label>
					<input type="text" id="login" name="login" required min="3">
					<label for="firstname">Firstname</label>
					<input type="text" id="firstname" name="firstname" required min="3">
					<label for="lastname">Lastname</label>
					<input type="text" id="lastname" name="lastname" required min="3">
					<label for="password">Password</label>
					<div class="subtitle">Your password may contain at least 8 character and a number.</div>
					<input type="text" id="password" name="password" required min="8">
					<label for="confirmPassword">Confirm password</label>
					<input type="text" id="confirmPassword" name="confirmPassword" required min="8">

					<input type="submit" name="submit" id="submit" value="Submit">
					<input type="reset" name="reset" id="reset" value="Reset">
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