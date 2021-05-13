<?php
	function IsPalindrome($string){
		$output = true;
		$i = 0;
		if (strlen($string) > 2){
			while ($output == true && $i < strlen($string)/2) {
				if ($string[$i] != $string[strlen($string)-($i+1)])
					$output = false;
				$i++;
			}
			var_dump($output);
		}else{
			echo "
				<script>
					alert('Le test IsPalidrome est trivial.');
				</script>
			";
		}
	}
	
	function IsPalindrome2($string){
		if (strlen($string) > 2){
			if ($string == strrev($string))
				var_dump(true);
			else
				var_dump(false);
		}else{
			echo "
				<script>
					alert('Le test IsPalidrome est trivial.');
				</script>
			";
		}
	}
?>