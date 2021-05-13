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

	// $conn = new mysqli(SERVER, USER, PASSWD, BASE);

	// Create client : only for professor use
	function AddMark($conn){
		$req = 'INSERT INTO Mark (MATTER, STUDENT, PROFESSOR, MARK) VALUES (:MATTER, :STUDENT, :PROFESSOR, :MARK)';

		try{
			// Prepared request
			$result = $conn->prepare($req);

			$result->bindValue(':MATTER', $_GET['matter'],       PDO::PARAM_STR);
			$result->bindValue(':STUDENT', $_GET['student'],     PDO::PARAM_STR);
			$result->bindValue(':PROFESSOR', $_GET['professor'], PDO::PARAM_STR);
			$result->bindValue(':MARK', $_GET['mark'],           PDO::PARAM_INT);

			// Execute request
			$result->execute();

			// Close database
			$result->closeCursor();

			// Insertion feedback
			echo '<script>alert("Data insertion executed!");</script>';
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

		$req = 'SELECT LOGIN, LASTNAME, FIRSTNAME
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