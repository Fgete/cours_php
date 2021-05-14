<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>L A G - BDD Test</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png">
		<link rel="stylesheet" type="text/css" href="../css/login.css">
	</head>
	<body>


		<h1>BDD Test</h1>
		<h2>Recherche dans table</h2>
		<?php
			include "./TD_school_database.php";
			$conn = ConnectDatabase();
			$marks = GetMarkTestList($conn);

			var_dump($marks);
		?>
	</body>
</html>