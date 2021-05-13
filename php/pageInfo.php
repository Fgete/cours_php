<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			$titre = "Les variables en php";
			echo "<title>$titre</title>";
		?>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
		<link rel="stylesheet" type="text/css" href="../css/page.css">
	</head>
	<body>
		<a href="../index.php"><< Retour index</a>

		<fieldset>
			<legend>PHP</legend>
			<?php
				echo "<h3>Information sur l'environnement</h3>";
				// phpinfo();
				// var_dump($_SERVER["SERVER_NAME"]);

				// $monServeur = $_SERVER["SERVER_NAME"];
				$monFichier = "/mon_site_web_dynamique/index.php";

				$mb = 37.2;

				echo '<p>Le contenu de la variable $mb est '.$mb.'.</p>';
				echo "<p>Le contenu de la variable mb est $mb.</p>";
				echo "<p>Son type est ".gettype($mb).".</p>";

				// Definir le type d'une variable
				settype($mb, "integer");
				echo "<p>Le contenu de la variable mb est $mb.</p>";
				echo "<p>Son type est ".gettype($mb).".</p>";

				echo is_int($mb);
				echo is_double($mb);

				$string = "bibabibabu";

				echo is_string($mb);
				echo is_string($string);

				$nb1 = 5;
				$nb2 = "5";
				var_dump($nb1 == $nb2);
				var_dump($nb1 === $nb2);

				// Tester l'exitence d'une variable
				if (!isset($string2))
					var_dump("/!\ string2 non défini /!\\");
				if (isset($string))
					unset($string);
				if (!isset($string))
					var_dump("/!\ string non défini /!\\");

				// Constantes
				define("USER", "toto & tutu");
				echo USER;

				$_GLOBALS["moi"] = "je";
				$_GLOBALS["action"] = "partir";

				var_dump($_GLOBALS);
				echo $_GLOBALS["moi"], $_GLOBALS["action"];

			




				echo "<br/><a href=".$monFichier.">Retour index</a>";

				

			?>
		</fieldset>
	</body>
</html>