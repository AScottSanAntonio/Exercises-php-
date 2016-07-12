<?php  
 
$numbers = array( 1, 2, 3, 4, 5);

foreach ($numbers as $value) {
	echo "{value}\n";

	foreach (range(1, 10) as $i) {
		if ($i ==2 ){
			echo "{$1}\n";
			break 2;
		}
	}
}

echo "done!\n";