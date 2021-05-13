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

		<script> // To stay logged in
			localStorage.setItem('isLogged', true);
		</script>

		<?php
			include "./TD_users.php";

			session_start();

			if ($_GET['role'] == 'teacher'){
				// --- BUILD TEACHER INTERFACE ---
				?>

				<!-- TEACHER HTML -->
				<h1>Hello <?php echo $_GET['login']; ?></h1>
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
							foreach ($studentList as $student)
								echo "<tr><td>".$student['name']."</td><td>".$student['domain']."</td><td>".$student['mark']."</td></tr>";
						?>
					</tbody>
				</table>
				<fieldset>
					<legend>Add mark</legend>
					<form method="post">
						<!-- NAME -->
						<label for="name">Student :</label>
					    <select name="name" id="name" required>
					    	<option value="" selected>--- Student ---</option>
				        	<?php
				        		$uniques = [];
								foreach ($studentList as $student)
									if (!in_array($student['name'], $uniques)){
										echo "<option value='".$student['name']."'>".$student['name']."</option>";
										array_push($uniques, $student['name']);
									}
							?>
				       </select>
				       <!-- DOMAIN -->
						<label for="domain">Domain :</label>
					    <select name="domain" id="domain" required>
					    	<option value="" selected>--- Domain ---</option>
				        	<?php
				        		$uniques = [];
								foreach ($studentList as $student)
									if (!in_array($student['domain'], $uniques)){
										echo "<option value='".$student['domain']."'>".$student['domain']."</option>";
										array_push($uniques, $student['domain']);
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
			}else if ($_GET['role'] == 'student'){
				// --- BUILD STUDENT INTERFACE ---
				?>

				<!-- STUDENT HTML -->
				<h1>Hello <?php echo $_GET['login']; ?></h1>
				<table id="studentTable">
					<thead>
						<tr>
							<th colspan="2"><?php echo $_GET['login']; ?></th>
						</tr>
						<tr>
							<th>Domain</th>
							<th>Mark</th>
						</tr>
					</thead>
					<tbody id="studentTableBody">
						<?php
						foreach ($studentList as $student)
							if ($student['name'] == $_GET['login']) {
								echo "<tr><td>".$student['domain']."</td><td>".$student['mark']."</td></tr>";
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

			if ($_GET['role'] == 'teacher' && sizeof($_POST) != 0){
				$newName = $_POST['name'];
				$newDomain = $_POST['domain'];
				$newMark = $_POST['mark'];

				echo "Your trying to add a <span class='bold'>".$newMark."</span> in <span class='bold'>".$newDomain."</span> to <span class='bold'>".$newName."</span>.<br>";
			}
		?>
		<a href="./TD_Logout.php">Logout -></a>
	</body>
</html>