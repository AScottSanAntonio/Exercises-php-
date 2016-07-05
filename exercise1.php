<?php
	
	$guessCount = 0;

	if ($argc == 3 && is_numeric($argv[1]) && is_numeric($argv[2]) && $argv[1] < $argv[2]) {
		echo "Your number is between $argv[1] and $argv[2]\n";
		$randomNumber = mt_rand($argv[1], $argv[2]);
		fwrite(STDOUT, 'Guess: ');
		$guess = trim(fgets(STDIN));
		
	
		do {
			
			if ($guess < $randomNumber) {
					fwrite(STDIN, "HIGHER\n");
					$guess = trim(fgets(STDIN));
					$guessCount++;
			} elseif ($guess > $randomNumber) {
					fwrite(STDOUT, "LOWER\n");
					$guess = trim(fgets(STDIN));
					$guessCount++;
			} else {
					fwrite(STDOUT, "DUN DUN DUN DUNNNNNN!\n");
			}
			$guessCount++;
		} while ($guess != $randomNumber);
	} 
		fwrite(STDOUT, "Correct! You guessed $guessCount times.");
	
