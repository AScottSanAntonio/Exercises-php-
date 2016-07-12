<?php
	 
	$i = 0;
	for ($i = 1; $i < 100; $i++ ) {
		if ($i % 3 == 0 && $i % 5 == 0) {
			echo "fizzbuzz\n";
		} else if ($i % 3 == 0) {
			echo "fizz\n";
		} else if ($i % 5 == 0) {
			echo "buzz\n";
		} else {
			echo "$i\n";
		}
	}
	$say = "Me not that kind of orc"; 
	`say "$say"`;


