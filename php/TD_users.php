<?php
	$userList = array(
		array("login"=>"prof0", "password"=>"1234", "role"=>"teacher"),
		array("login"=>"prof1", "password"=>"4321", "role"=>"teacher"),
		array("login"=>"stud0", "password"=>"0000", "role"=>"student"),
		array("login"=>"stud1", "password"=>"1111", "role"=>"student")
	);

	$studentList = array(
		array("name"=>"John Smith" , "domain"=>"Web" , "mark"=>18),
		array("name"=>"Sarah Konor", "domain"=>"Algo", "mark"=>17),
		array("name"=>"Guy Tylor"  , "domain"=>"GD"  , "mark"=>12),
		array("name"=>"stud0"      , "domain"=>"GD"  , "mark"=>15),
		array("name"=>"stud0"      , "domain"=>"Web" , "mark"=>10),
		array("name"=>"stud1"      , "domain"=>"Web" , "mark"=>9 )
	);

	$domainList = array_column($studentList,'domain');
    array_multisort($domainList, SORT_ASC, $studentList);

    // PERSISTENCE DES DONNEES
    // - les fichiers (.txt .xml)
    // - les BDDs
?>