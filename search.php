<?php


$names = ['Tina', 'Dana', 'Mike', 'Amy', 'Adam'];
$compare = ['Tina', 'Dean', 'Mel', 'Amy', 'Michael'];


fwrite(STDOUT, "Please enter a name \n");
$name = trim(fgets(STDIN));

if (is_int($result)) {
	$result = array_search($name, $names ,strict);
    //echo $names[$result];
    echo 'found it' . PHP_EOL;
}else{
	echo 'DONE GOOFED' . PHP_EOL;
}

