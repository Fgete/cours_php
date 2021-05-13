<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>L A G - TD Chaine</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
		<link rel="stylesheet" type="text/css" href="../css/page.css">
	</head>
	<body>
		<a href="../index.php"><< Retour index</a>

		<?php
			include "TD_Chaine_include.php";

			$initialTime = microtime(true);

			$string0 = "PhraseDeTeste";
			$string1 = "Phrase de teste.";

			$email0 = "f.gete@ludus-academie.com";

			$phone0 = "06 33 44 55 66";
			$phone1 = "06-33-44-55-66";
			$phone2 = "0633445566";

			$matricule0 = "12e2t";
			$matricule1 = "12eag";
			$matricule2 = "gye25";

			// --- EXERCICE 1 ---
			echo "<h3>EXERCICE 1</h3>";

			// Question 1 - Tester si une chaine contient que des lettres.
			echo "<h4>Question 1</h4>";

			var_dump(ctype_alpha($string0));
			var_dump(ctype_alpha($string1));

			// Question 2 - Tester si une chaine contient un @.
			echo "<h4>Question 2</h4>";

			var_dump(preg_match("/@/i", $email0) > 0);
			var_dump(strpos($email0, "@") > 0);
			var_dump(preg_match("/@/i", $string0) > 0);

			// Question 3 - Tester si une chaine correspond à :
			echo "<h4>Question 3</h4>";
			echo "<h5>Numéro de téléphone</h5>";

				// 00 00 00 00 00 ou 00-00-00-00-00
			var_dump(IsPhoneNumber($phone0));
			var_dump(IsPhoneNumber($phone1));
			var_dump(IsPhoneNumber($phone2));

			echo "<h5>Matricule</h5>";
				// aaa00;
			var_dump(IsMatricule($matricule0));
			var_dump(IsMatricule($matricule1));
			var_dump(IsMatricule($matricule2));

			// --- EXERCICE 2 ---
			echo "<h3>EXERCICE 2</h3>";

			// Question 1 - Egalités.
			echo "<h4>Question 1</h4>";

			$a=2;
			$b=12;
			$r=$a+$b;

			echo "<h5>Echo</h5>";
			echo "<p>$a+$b=$r</p>";
			echo '<p>$a+$b='.$r.'</p>';

			echo "<h5>Print</h5>";
			print "<p>$a+$b=$r</p>";
			print '<p>$a+$b='.$r.'</p>';

			// Question 2 - Mots avec majuscule dans un phrase.
			echo "<h4>Question 2</h4>";

			PrintUpperCaseWord($string1);

			// Question 3 - Formater l'affichage d'un sommaire.
			echo "<h4>Question 3</h4>";

			// Titre
			$titre1 = "Structures de base";
			$titre2 = "Les classes";

			// Numero de page
			$page1 = "1";
			$page2 = "5";

			echo "<p>".str_pad($titre1, 100-strlen($titre1), '.', STR_PAD_RIGHT).$page1."</p>";
			echo "<p>".str_pad($titre2, 100-strlen($titre2), '.', STR_PAD_RIGHT).$page2."</p>";

			// Question 4 - Ecrire les codes ASCII.
			echo "<h4>Question 4</h4>";

			$string2 = "PHP 7 news";
			for ($i = 0; $i < strlen($string2); $i++)
				var_dump(ord(substr($string2, $i, 1)));

			// Question 5 - Afficher la chaine "<ul><li>item1</li><li>item2</li></ul>"
			$string3 = htmlspecialchars("<ul><li>item1</li><li>item2</li></ul>");
			echo $string3;

			// --- EXERCICE 3 --- (structures de contrôle)
			echo "<h3>EXERCICE 3</h3>";

			// Question 1 - Itération de while.
			echo "<h4>Question 1</h4>";

			$initial = 249;
			$iteration = 0;

			while (random_int(100, 1000) != $initial)
				$iteration++;

			var_dump($iteration);

			// Question 2 - Multiples de 3.
			echo "<h4>Question 2</h4>";

			MultiplesDeTrois(18);

			// Question 3 - Est premier ?
			echo "<h4>Question 3</h4>";

			var_dump(IsPrimary(18));
			var_dump(IsPrimary(29));

			// Question 4 - Est premier ?
			echo "<h4>Question 4</h4>";

			$note0 = 5;
			$note1 = 10;
			$note2 = 18;

			var_dump(Grade($note0));
			var_dump(Grade($note1));
			var_dump(Grade($note2));

			// Question 5 - Multiple de 3 & 7
			echo "<h4>Question 5</h4>";

			var_dump(Multiple37(18));
			var_dump(Multiple37(21));

			// Question 6 - Multiple de 3 & 7
			echo "<h4>Question 6</h4>";

			var_dump(Operation(5,9,'*'));

			// Question X - Constantes magiques
			echo "<h4>Question X</h4>";

			// version du php
			var_dump(phpversion());
			// system d'exploitation server
			var_dump($_SERVER["SERVER_SOFTWARE"]);
			// fichier courant
			var_dump($_SERVER["PHP_SELF"]);
			// host
			var_dump($_SERVER["HTTP_HOST"]);
			// langue navigateur
			var_dump(explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"])[0]);

			// --- EXERCICE 4 --- (dates)
			echo "<h3>EXERCICE 4</h3>";

			// Question 1 - Mon age
			echo "<h4>Question 1</h4>";

			var_dump(MonAge(1997-02-04));

			// Question 2 - Chack date
			echo "<h4>Question 2</h4>";

			var_dump(checkdate(29, 02, 2010));

			// Question 3 - Chack date
			echo "<h4>Question 3</h4>";

			function IsWeekEnd($date){
				if (date('D', strtotime($date)) == "Fri" || date('D', strtotime($date)) == "Mon")
					return var_dump("Weekend prolongé !");
			}

			IsWeekEnd(2016-05-01);

			// Question 4 - Script time
			echo "<h4>Question 4</h4>";

			$deltaTime = microtime(true);
			var_dump($deltaTime - $initialTime);

			// Question 5 - Date & heure
			echo "<h4>Question 5</h4>";

			var_dump(date('l, j F Y h:m:s'));
			var_dump(date('l/F/Y'));
			var_dump(date('j/F/Y'));
			var_dump(date('j-m-y'));
			var_dump(date('h\h: m\m: s\s'));

			// Question 6 - Date & heure en français
			echo "<h4>Question 5</h4>";

			setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
			var_dump(strftime("%A %d %B %Y").date(', h:m'));
			var_dump(strftime("%d %B %Y"));
		?>

	</body>
</html>