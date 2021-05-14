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

		<form method="POST">
			<label for="search">Enter student name :</label>
			<input type="text" name="searchStudent" placeholder="Student">
			<input type="text" name="searchMatter" placeholder="Matter">
			<input type="submit" name="submit">
		</form>

		<?php
			include "./TD_school_database.php";
			$conn = ConnectDatabase();
			$marks = GetMarkList($conn);
			$searchStudent = null;
			$searchMatter = null;

			if ($_POST != null){
				$searchStudent = $_POST['searchStudent'];
				$searchMatter = $_POST['searchMatter'];
			}

			var_dump($_POST);
			var_dump(strlen($searchMatter));

			// Afficher la liste des notes des étudiants --OK
			// Rechercher par nom de l'étudiant --OK
			// Affiché la moyenne de l'étudiant appelé
			// Faire des photos aux étudiants

			// $nb = $req->rowCount();

			if ($marks == null)
				echo "<h2>WARNING -- No data found!</h2>";

		?>


		<table id="studentTable">
			<thead>
				<tr>
					<th colspan="3">Students</th>
				</tr>
				<tr>
					<th>Name</th>
					<th>Domain</th>
					<th>Mark</th>
				</tr>
			</thead>
			<tbody id="studentTableBody">
				<?php
					if (strlen($searchStudent)){
						if (strlen($searchMatter)){
							foreach ($marks as $mark)
								if ($mark['STUDENT'] == $searchStudent && $mark['MATTER'] == $searchMatter)
									echo "<tr><td>".$mark['STUDENT']."</td><td>".$mark['MATTER']."</td><td>".$mark['MARK']."</td></tr>";
						}
						else{
							foreach ($marks as $mark)
								if ($mark['STUDENT'] == $searchStudent)
									echo "<tr><td>".$mark['STUDENT']."</td><td>".$mark['MATTER']."</td><td>".$mark['MARK']."</td></tr>";
						}
					}else{
						if (strlen($searchMatter)){
							foreach ($marks as $mark)
								if ($mark['MATTER'] == $searchMatter)
									echo "<tr><td>".$mark['STUDENT']."</td><td>".$mark['MATTER']."</td><td>".$mark['MARK']."</td></tr>";
						}
						else{
							foreach ($marks as $mark)
								echo "<tr><td>".$mark['STUDENT']."</td><td>".$mark['MATTER']."</td><td>".$mark['MARK']."</td></tr>";
						}
					}
						
				?>
			</tbody>
		</table>


		<?php
			$studentFound = false;
			$sommeMark = 0;
			$numberMark = 0;

			foreach ($marks as $mark)
				if ($mark['STUDENT'] == $searchStudent){
					$studentFound = true;
					$sommeMark += $mark['MARK'];
					$numberMark++;
				}

			if (!$studentFound)
				echo "<h3>WARNING -- Student not found!</h3>";
			else
				echo "Student global average : ".($sommeMark / $numberMark);
		?>
		

	</body>
</html>