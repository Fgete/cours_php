<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>L A G - TD Authentified</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
		<link rel="stylesheet" type="text/css" href="../css/authentified.css">
	</head>
	<body>
		<a href="../index.php"><< Retour index</a>

		<?php
			include "./TD_school_database.php";

			session_start();

			// Get user infos
			$conn = ConnectDatabase();
			$user = GetUserByLogin($conn, $_SESSION['login']);

			$marks = GetMarkList($conn);

			if ($user['ROLE'] == 'professor'){
				// --- BUILD TEACHER INTERFACE ---
				?>

				<!-- TEACHER HTML -->
				<h1>Hello <?php echo $user['FIRSTNAME']; ?></h1>

				<form method="POST">
					<label for="search">Enter student name :</label>
					<input type="text" name="searchStudent" placeholder="Student">
					<input type="text" name="searchMatter" placeholder="Matter">
					<input type="submit" name="submit">
				</form>

				<?php

					$searchStudent = null;
					$searchMatter = null;

					if ($_POST != null){
						if (isset($_POST['searchStudent']))
							$searchStudent = $_POST['searchStudent'];
						if (isset($_POST['searchMatter']))
							$searchMatter = $_POST['searchMatter'];
					}

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
							<th>Matter</th>
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
				<fieldset>
					<legend>Add mark</legend>
					<form method="post">
						<!-- NAME -->
						<label for="name">Student :</label>
					    <select name="name" id="name" required>
					    	<option value="" selected>--- Student ---</option>
				        	<?php
				        		$uniques = [];
								foreach ($marks as $mark)
									if (!in_array($mark['STUDENT'], $uniques)){
										echo "<option value='".$mark['STUDENT']."'>".$mark['STUDENT']."</option>";
										array_push($uniques, $mark['STUDENT']);
									}
							?>
				       </select>
				       <!-- DOMAIN -->
						<label for="matter">Matter :</label>
					    <select name="matter" id="matter" required>
					    	<option value="" selected>--- Matter ---</option>
				        	<?php
				        		$uniques = [];
								foreach ($marks as $mark)
									if (!in_array($mark['MATTER'], $uniques)){
										echo "<option value='".$mark['MATTER']."'>".$mark['MATTER']."</option>";
										array_push($uniques, $mark['MATTER']);
									}
							?>
				       </select>
				       <!-- MARK -->
						<label for="mark">Mark :</label>
					    <input type="number" name="mark" id="mark" min="0" max="20" placeholder="Mark" required>

						<input type="reset" name="reset" value="Reset">
						<input type="submit" name="submit" value="Submit">
					</form>
				</fieldset>

				<?php
			}else if ($user['ROLE'] == 'student'){
				// --- BUILD STUDENT INTERFACE ---
				?>

				<!-- STUDENT HTML -->
				<h1>Hello <?php echo $user['FIRSTNAME']; ?></h1>
				<table id="studentTable">
					<thead>
						<tr>
							<th colspan="2"><?php echo $user['FIRSTNAME']; ?></th>
						</tr>
						<tr>
							<th>Domain</th>
							<th>Mark</th>
						</tr>
					</thead>
					<tbody id="studentTableBody">
						<?php
						foreach ($marks as $mark)
							if ($mark['STUDENT'] == $user['FIRSTNAME']) {
								echo "<tr><td>".$mark['MATTER']."</td><td>".$mark['MARK']."</td></tr>";
							}
						?>
					</tbody>
				</table>

				<?php
			}else{
				// --- BUILD DEFAULT INTERFACE ---
				?>

				<!-- DEFAULT HTML -->

				<?php
			}
			
			if ($user['ROLE'] == 'professor' && sizeof($_POST) != 0){

				$newName = null;
				$newMatter = null;
				$newMark = null;

				if (isset($_POST['name']))
					$newName = $_POST['name'];
				if (isset($_POST['matter']))
					$newMatter = $_POST['matter'];
				if (isset($_POST['mark']))
					$newMark = $_POST['mark'];

				$newLogin = null;
				foreach ($marks as $mark)
					if ($mark['STUDENT'] == $newName)
						$newLogin = $mark['LOGIN'];

				if ($newName && $newMatter && $newMark)
					AddMark($conn, $newLogin, $newMatter, $newMark);
			}
			
		?>
		<a href="./TD_Logout.php">Logout -></a>
	</body>
</html>