<?php 

	$classes = [];
	$grades = [];

	
	do {
		fwrite(STDOUT, "Please input class.\n");
		array_push($classes, fgets(STDIN));
		fwrite(STDOUT, "Please input grades.\n");
		array_push($grades, fgets(STDIN)); 
		fwrite(STDOUT, "Add any more grades?\n");
		$continue = trim(fgets(STDIN));
	} while ($continue = "y");
	
			
		
	
	$solution = array_sum($grades);
	echo $solution / count($grades) . "\n";



