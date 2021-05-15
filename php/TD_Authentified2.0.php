<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>L A G - TD Authentified</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
		<link rel="stylesheet" type="text/css" href="../css/authentified.css">
	</head>
	<body>
		<div id="navigationPanel">
			<div class="button">
				<a href="../index.php">Retour index</a>
			</div>

		<?php
			include "./TD_school_database.php";

			session_start();

			// Get user infos
			$conn = ConnectDatabase();
			$user = null;
			if (isset($_SESSION['login']))
				$user = GetUserByLogin($conn, $_SESSION['login']);

			$marks = GetMarkList($conn);
			$students = GetStudentList($conn);

			if ($user['ROLE'] == 'professor'){
				// --- BUILD TEACHER INTERFACE ---
				?>
					<div class="button">
						<a href="./TD_Logout2.0.php">Logout</a>
					</div>
				</div>

				<!-- TEACHER HTML -->
				<div id="contentPanel">
					<div id="userPanel">
						<h1>Hello <?php echo $user['FIRSTNAME']; ?></h1>
						<?php echo '<img id="profilPicture" src="../images/users/'.$user["LOGIN"].'.jpg">'; ?>
					</div>

					<div id="dataPanel">
						<fieldset>
							<legend>Search</legend>
							<form method="POST">
								<label for="search">Enter student name :</label>
								<input type="text" name="searchStudent" placeholder="Student">
								<input type="text" name="searchMatter" placeholder="Matter">
								<input type="submit" name="submit" value="Submit">
							</form>
						</fieldset>

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

						<div id="tablePanel">
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
						</div>

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

							if (!$studentFound && strlen($searchStudent))
								echo "<h3>WARNING -- Student not found!</h3>";
							else if (strlen($searchStudent))
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
										foreach ($students as $student)
											if (!in_array($student['LASTNAME']." ".$student['FIRSTNAME'], $uniques)){
												echo "<option value='".$student['LASTNAME']." ".$student['FIRSTNAME']."'>".$student['LASTNAME']." ".$student['FIRSTNAME']."</option>";
												array_push($uniques, $student['LASTNAME']." ".$student['FIRSTNAME']);
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
					</div>
				</div>

				<?php
			}else if ($user['ROLE'] == 'student'){
				// --- BUILD STUDENT INTERFACE ---
				?>
					<div class="button">
						<a href="./TD_Logout2.0.php">Logout</a>
					</div>
				</div>

				<!-- STUDENT HTML -->
				<div id="contentPanel">
					<div id="userPanel">
						<h1>Hello <?php echo $user['FIRSTNAME']; ?></h1>
						<?php echo '<img id="profilPicture" src="../images/users/'.$user["LOGIN"].'.jpg">'; ?>
					</div>

					<div id="dataPanel">
						<div id="tablePanel">
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
										if ($mark['STUDENT'] == ($user['LASTNAME']." ".$user['FIRSTNAME'])) {
											echo "<tr><td>".$mark['MATTER']."</td><td>".$mark['MARK']."</td></tr>";
										}
									?>
								</tbody>
							</table>
						</div>

						<?php
							$studentFound = false;
							$sommeMark = 0;
							$numberMark = 0;

							foreach ($marks as $mark)
								if ($mark['STUDENT'] == ($user['LASTNAME']." ".$user['FIRSTNAME'])){
									$studentFound = true;
									$sommeMark += $mark['MARK'];
									$numberMark++;
								}

							if (!$studentFound)
								echo "<h3>You don't have any marks.</h3>";
							else
								echo "Your global average : ".($sommeMark / $numberMark);
						?>
					</div>
				</div>

				<?php
			}else{
				// --- BUILD DEFAULT INTERFACE ---
				?>

				<!-- DEFAULT HTML -->
				<h1>You are not logged !</h1>
				<h3>Please log you in :</h3>
				<a href="./TD_Login2.0.php">Login -></a>

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

				unset($_POST);
			}
			
		?>
	</body>
</html>