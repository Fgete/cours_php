<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>L A G - PHP_Page0</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
		<link rel="stylesheet" type="text/css" href="../css/page.css">
	</head>
	<body>
		<a href="../index.php"><< Retour index</a>

		<fieldset>
			<legend>PHP</legend>
			<?php
				include "utiles.php";
				// require "utiles.php";
				// include_once "utiles.php";

				echo "Bonjour";
				echo "<h2>Bonjour</h2>";
				echo date('d/m/Y h:i:s');

				$chaine = "saucisse";
				$chaine2 = "saperlipopette";

				$longueurChaine = strlen($chaine);
				var_dump($longueurChaine);

				$exploded = explode('p', $chaine2);
				var_dump($exploded);
				var_dump(gettype($exploded));
				var_dump(is_array($exploded));
				var_dump(sizeof($exploded));

				var_dump($exploded[sizeof($exploded)-1]);

				var_dump(strtoupper($chaine)); // Upper casse all
				var_dump(strtolower($chaine)); // Lower casse all
				var_dump(ucfirst($chaine)); // Upper casse first char
				var_dump(ucwords($chaine)); // Upper casse each word
				var_dump(strstr($chaine, 'c')); // Prend ce qu'il y a après
				var_dump(stristr($chaine, 'c')); // Prend ce qu'il y a après
				var_dump(preg_match("/cis/i", $chaine)); // Check s'il y a le mot dans le chaine



				IsPalindrome2($exploded[sizeof($exploded)-1]); // "ette"
				IsPalindrome2($exploded[1]); // "erli"
				IsPalindrome2($exploded[sizeof($exploded)-2]); // "o"

			?>
		</fieldset>

	</body>
</html>