<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>L A G - TD Login</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
		<link rel="stylesheet" type="text/css" href="../css/login.css">
	</head>
	<body>

		<!-- PHP -->
		<?php
			include "./TD_users.php";

			// V2.0
			// créer un formulaire 'REGISTER' (créer un compte)
			// tester si le pwd est correct (A0*x2)
			// tester si l'utilisateur n'éxiste pas déjà en base
			// créer un formulaire 'LOGIN' (connexion)

			// créer base de notes
			// rechercher par requête les notes
			// formulaire d'ajout de note dans la base (refresh)

			session_start();

			if (sizeof($_POST) != 0){
				$login = $_POST["login"];
				$password = $_POST["password"];

				$sessionRole = null;
				foreach ($userList as $user){
					if ($login == $user['login'] && $password == $user['password'])
						$sessionRole = $user['role'];
				}

				// var_dump($sessionRole);

				if ($sessionRole != null)
					header("Location: ./TD_Authentified.php?role=".$sessionRole."&login=".$login);
				else{
					header("Location: ./TD_login.php?erreur=1");
				}
			}
		?>

		<a href="../index.php"><< Retour index</a>

		<!-- LOGIN FORM -->
		<div id="loginPanel">
			<form id="loginForm" method="post">
				<h1>Authentification</h1>
				<h5 id="invalid">Invalid login or password</h5>

				<label for="password">Login</label>
				<input type="text" id="login" name="login" required>
				<label for="password">Password</label>
				<input type="text" id="password" name="password" required hidden>
				<input type="text" id="fakePassword" disabled>

				<input type="submit" name="submit" id="submit" value="Submit" onclick="Auth()">
				<input type="reset" name="reset" id="reset" value="Reset">

				<div id="numberPanel">
					<div class="numberRow">
						<div id="number1" class="numberButton" onclick="PushNumber('number1')"></div>
						<div id="number2" class="numberButton" onclick="PushNumber('number2')"></div>
						<div id="number3" class="numberButton" onclick="PushNumber('number3')"></div>
						<div id="number4" class="numberButton" onclick="PushNumber('number4')"></div>
						<div id="number5" class="numberButton" onclick="PushNumber('number5')"></div>
					</div>
					<div class="numberRow">
						<div id="number6" class="numberButton" onclick="PushNumber('number6')"></div>
						<div id="number7" class="numberButton" onclick="PushNumber('number7')"></div>
						<div id="number8" class="numberButton" onclick="PushNumber('number8')"></div>
						<div id="number9" class="numberButton" onclick="PushNumber('number9')"></div>
						<div id="number0" class="numberButton" onclick="PushNumber('number0')"></div>
					</div>
				</div>
			</form>
		</div>

		<!-- ALREADY LOGGED -->
		<div id="alreadyLoggedPanel">
			<h1>You are already logged.</h1>
			<a href="./TD_Logout.php">Logout -></a><br>
			<a href="./TD_Authentified.php">Next -></a>
			
		</div>
		
		<!-- SCRIPT -->
		<script>
			var loginPanel = document.getElementById("loginPanel");
			var alreadyLoggedPanel = document.getElementById("alreadyLoggedPanel");

			// --- IF LOGGED ---
			if (localStorage.isLogged){
				loginPanel.style.display = "none";
				alreadyLoggedPanel.style.display = "block";
			}else{
				loginPanel.style.display = "flex";
				alreadyLoggedPanel.style.display = "none";
			}

			var numberList = document.getElementsByClassName("numberButton");
			var login = document.getElementById("login");
			var password = document.getElementById("password");
			var fakePassword = document.getElementById("fakePassword");

			// --- FILL BUTTONS ---
			for (var i = 0; i <= 9; i++){
				var nButton = Math.floor(Math.random() * 10); // 0 - 9
				while (numberList[nButton].innerHTML != "")
					var nButton = Math.floor(Math.random() * 10);
				numberList[nButton].innerHTML = i;
			}

			// --- PUSH IN PASSWORD ---
			function PushNumber(buttonId){
				var button = document.getElementById(buttonId);

				password.value = password.value + button.innerHTML;
				fakePassword.value = fakePassword.value + button.innerHTML;
			}

			// --- LOCAL STORAGE ---
			function Auth(){
				myStorage = localStorage;
				myStorage.clear();
				myStorage.setItem('login', login.value);
				myStorage.setItem('password', password.value);
			}
		</script>

		<!-- PHP -->
		<?php
			if (isset($_GET["erreur"])){
				echo "
					<script>
						document.getElementById('invalid').style.display = 'block';
					</script>
				";
			}
		?>

	</body>
</html>