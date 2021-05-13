<?php
	// EXO 1 | Question 3 - Numero de téléphone
	function IsPhoneNumber($string){
		if (strlen($string) != 14)
			return false;
		if (is_numeric(join("", explode(" ", $string))) + strlen(join("", explode(" ", $string)) == 10))
			return true; // 00 00 00 00 00
		else if (is_numeric(join("", explode("-", $string))) + strlen(join("", explode("-", $string)) == 10))
			return true; // 00-00-00-00-00
		else
			return false;
	}

	// EXO 1 | Question 3 - Matricule
	function IsMatricule($string){
		if (strlen($string) >= 5)
			if (ctype_alpha(substr($string, 0, 3)) && is_numeric(substr($string, strlen($string)-2, 2)))
				return true;
		else return false;
	}

	// EXO 2 | Question 2 - Mots avec une majuscule dans une phrase
	function PrintUpperCaseWord($string){
		foreach (explode(" ", $string) as $word)
			if (ctype_upper(substr($word, 0, 1)))
				var_dump($word);
	}

	// EXO 3 | Question 2 - Multiples de trois
	function MultiplesDeTrois($limit){
		for ($i = 0; $i < $limit; $i++)
			if ($i % 3 == 0)
				var_dump($i);
	}

	// EXO 3 | Question 3 - Est premier ?
	function IsPrimary($number){
		for ($i = 2; $i < $number; $i++)
			if ($number % $i == 0)
				return false;
		return true;
	}

	// EXO 3 | Question 4 - Grades.
	function Grade($note){
		if ($note >= 18)
			return 'A';
		else if ($note >= 14)
			return 'B';
		else if ($note >= 10)
			return 'C';
		else 
			return 'D';
	}

	// EXO 3 | Question 5 - Multiple 3 & 7
	function Multiple37($number){
		return ($number % 3 == 0 && $number % 7 == 0);
	}

	// EXO 3 | Question 6 - Operations.
	function Operation($nA, $nB, $operation){
		switch ($operation){
			case '+': return $nA + $nB; break;
			case '-': return $nA - $nB; break;
			case '*': return $nA * $nB; break;
			case '/':
				if ($nB != 0)
					return $nA / $nB; break;
			break;
		}
	}

	// EXO 4 | Question 1 - Mon age (1997-02-04)
	function MonAge($date){
		return floor((time() - strtotime($date))/31556926);
	}
?>