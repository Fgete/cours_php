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
			// Le résultat d'une requète SQL est un tableau associatif
			echo "<h3>IMC (complément)</h3>";
			$imc = array(
				array("Sous-alimentation", "min"=>0, "max"=>15),
				array("Maigreur", "min"=>15, "max"=>18.5),
				array("Normal", "min"=>18.5, "max"=>25),
				array("Surcharge pondérale", "min"=>25, "max"=>30),
				array("Surpoids", "min"=>30, "max"=>35),
				array("Obésité", "min"=>35, "max"=>40),
				array("Obésité extrème", "min"=>40, "max"=>45)
			);

			echo "<h3>Matrices</h3>";

			$binome2 = array(13, 8);
			$binome3 = array(2, 1);

			$carre0 = array("A"=>5, "B"=>18, "C"=>11, "D"=>7);
			$carre1 = array("A"=>13, "B"=>8, "C"=>2, "D"=>1);

			function MatrixSum($matA, $matB){
				$matrixSum = array(
					$matA['A']+$matB['A'],
					$matA['B']+$matB['B'],
					$matA['C']+$matB['C'],
					$matA['D']+$matB['D']
				);
				return $matrixSum;
			}

			function MatrixMultiply($matA, $matB){
				$matrixSum = array(
					$matA['A']*$matB['A']+$matA['B']*$matB['C'],
					$matA['A']*$matB['B']+$matA['B']*$matB['D'],
					$matA['C']*$matB['A']+$matA['D']*$matB['C'],
					$matA['C']*$matB['B']+$matA['D']*$matB['D']
				);
				return $matrixSum;
			}

			var_dump(MatrixSum($carre0, $carre1));
			var_dump(MatrixMultiply($carre0, $carre1));

			echo "<h3>Tableau associatif</h3>";

			$releveDeNote = array(
				array("nomEtudiant"=>"Franck", "note"=>18),
				array("nomEtudiant"=>"Sarah", "note"=>16),
				array("nomEtudiant"=>"Guy", "note"=>12)
			);

			$etudiant = array("nomEtudiant"=>"Svetlana", "note"=>8);

			array_push($releveDeNote, $etudiant);
			$releveDeNote[2]['note'] = null;

			var_dump($releveDeNote);

			function ExtremMark($studentList, $minMax){
				if ($minMax == 1){
					$note = $studentList[0]['note'];
					foreach ($studentList as $student)
						if ($student['note'] > $note)
							$note = $student['note'];
					return $note;
				} else if ($minMax == 0){
					$note = $studentList[0]['note'];
					foreach ($studentList as $student)
						if ($student['note'] < $note && $student['note'] != null)
							$note = $student['note'];
					return $note;
				} else {
					return null;
				}
			}

			var_dump(ExtremMark($releveDeNote, 0)); // MIN
			var_dump(ExtremMark($releveDeNote, 1)); // MAX
			var_dump(ExtremMark($releveDeNote, 2)); // ERROR

			
		?>

	</body>
</html>