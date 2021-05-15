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
			<h1>You are now logged out.</h1>
			<a href="./TD_Login2.0.php">Login -></a>
		</div>

		<?php
			session_start();
			
			if($_SESSION != null)
				unset($_SESSION);
			if($_POST != null)
				unset($_POST);
			if($_GET != null)
				unset($_GET);

			session_destroy();
			header("Location: ./TD_login2.0.php");
		?>
	</body>
</html>