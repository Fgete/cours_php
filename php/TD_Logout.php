<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>L A G - TD Logout</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
		<link rel="stylesheet" type="text/css" href="../css/logout.css">
	</head>
	<body>
		<a href="../index.php"><< Retour index</a>

		<div id="panel">
			<h1>You are logout now.</h1>
			<a href="./TD_Login.php">Login -></a>
		</div>

		<script>

			// --- DISCONNECT ---
			function Disconnect(){
				localStorage.clear();
			}

			Disconnect();
		</script>

		<?php
			session_start();
			if(isset($_SESSION["login"])){
				unset($_SESSION);
				session_destroy();
				header("Location:login.php");
			}
		?>
	</body>
</html>