<?php
	define('USER', "root");
	define('PASSWD', "");
	define('SERVER', "localhost");
	define('BASE', "school");

	// Connexion to database function
	function ConnectDatabase(){
		$dsn = "mysql:dbname=".BASE.";host=".SERVER;

		try{
			$connexion = new PDO($dsn, USER, PASSWD);
		}

		catch (PDOException $e){
			printf("Connexion failed : %s\n", $e->getMessage());
			exit();
		}

		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $connexion;
	}

	// Create client : only for professor use
	function AddUser($conn, $login, $password, $lastname, $firstname){
		$req = 'INSERT INTO User (LOGIN, PASSWORD, LASTNAME, FIRSTNAME, ROLE) VALUES (:LOGIN, :PASSWORD, :LASTNAME, :FIRSTNAME, :ROLE)';
		$addStu = 'INSERT INTO Student (LOGIN, LASTNAME, FIRSTNAME) VALUES (:LOGIN, :LASTNAME, :FIRSTNAME)';

		try{
			// Prepared request
			$result = $conn->prepare($req);
			$update = $conn->prepare($addStu);

			$result->bindValue(':LOGIN', $login, PDO::PARAM_STR);
			$result->bindValue(':PASSWORD', $password, PDO::PARAM_STR);
			$result->bindValue(':LASTNAME', $lastname, PDO::PARAM_STR);
			$result->bindValue(':FIRSTNAME', $firstname, PDO::PARAM_STR);
			$result->bindValue(':ROLE', 'student', PDO::PARAM_STR); // Default role set to student

			$update->bindValue(':LOGIN', $login, PDO::PARAM_STR);
			$update->bindValue(':LASTNAME', $lastname, PDO::PARAM_STR);
			$update->bindValue(':FIRSTNAME', $firstname, PDO::PARAM_STR);

			// Execute request
			$result->execute();
			$update->execute();

			// Close database
			$result->closeCursor();
			$update->closeCursor();

			// Insertion feedback
			// echo '<script>alert("Data insertion executed!");</script>';
		}

		catch(PDOException $e){
			echo "Error : ".$e->getMessage();
		}
	}

	function AddMark($conn, $login, $matter, $mark){
		$req = 'INSERT INTO Mark (MATTER, STUDENT, MARK) VALUES (:MATTER, :STUDENT, :MARK)';

		try{
			// Prepared request
			$result = $conn->prepare($req);

			$result->bindValue(':MATTER', $matter, PDO::PARAM_STR);
			$result->bindValue(':STUDENT', $login, PDO::PARAM_STR);
			$result->bindValue(':MARK', $mark, PDO::PARAM_INT);

			// Execute request
			$result->execute();

			// Close database
			$result->closeCursor();

			// Insertion feedback
			echo '<script>alert("Mark added to '.$login.'. Pleased reload to see the modifactions.");</script>';
		}

		catch(PDOException $e){
			echo "Error : ".$e->getMessage();
		}
	}

	function GetStudentList($conn){
		$students = [];
		$req = 'SELECT DISTINCT LOGIN, LASTNAME, FIRSTNAME
				FROM User
				WHERE ROLE = "student"
				ORDER BY LASTNAME';
		try{
			$result = $conn->query($req);

			while($data = $result->fetch(PDO::FETCH_ASSOC)){
				$students[] = $data;
			}

			$result->closeCursor();

			return $students;
		}
		catch(PDOException $e){
			echo "Error : ".$e->getMessage();
		}
	}

	function GetMarkList($conn){
		$marks = [];
		$req = 'SELECT CONCAT(User.LASTNAME, " ", User.FIRSTNAME) AS STUDENT, User.LOGIN, Mark.MATTER, Mark.MARK
				FROM Mark, User
				WHERE Mark.STUDENT = User.LOGIN';
		try{
			$result = $conn->query($req);

			while($data = $result->fetch(PDO::FETCH_ASSOC)){
				$marks[] = $data;
			}

			$result->closeCursor();

			return $marks;
		}
		catch(PDOException $e){
			echo "Error : ".$e->getMessage();
		}
	}

	function GetMarkTestList($conn){
		$marks = [];
		$req = 'SELECT *
				FROM MarkTest';
		try{
			$result = $conn->query($req);

			while($data = $result->fetch(PDO::FETCH_ASSOC)){
				$marks[] = $data;
			}

			$result->closeCursor();

			return $marks;
		}
		catch(PDOException $e){
			echo "Error : ".$e->getMessage();
		}
	}

	function GetLoginPassword($conn){
		$logPwd = [];
		$req = 'SELECT DISTINCT LOGIN, PASSWORD
				FROM User';
		try{
			$result = $conn->query($req);

			while($data = $result->fetch(PDO::FETCH_ASSOC)){
				$logPwd[] = $data;
			}

			$result->closeCursor();

			return $logPwd;
		}
		catch(PDOException $e){
			echo "Error : ".$e->getMessage();
		}
	}

	function GetUserByLogin($conn, $login){

		$req = 'SELECT LOGIN, LASTNAME, FIRSTNAME, ROLE
				FROM User
				WHERE LOGIN = "'.$login.'"';

		try{
			$result = $conn->query($req);

			$user = $result->fetch(PDO::FETCH_ASSOC);

			$result->closeCursor();

			return $user;
		}
		catch(PDOException $e){
			echo "Error : ".$e->getMessage();
		}
	}
?>