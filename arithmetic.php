<?php

function add($a, $b)
{
    return $a + $b;
}

function subtract($a, $b)
{
    return $a - $b;
}

function multiply($a, $b)
{
    return $a * $b;
}

function divide($a, $b)
{
    return $a / $b;
}

$a = 2;
$b = 4;

$say1  = "$a plus $b equals"; 
	`say -v "Fred" "$say1"`;
echo add($a, $b) . PHP_EOL;

$say2 = "$a minus $b equals"; 
	`say -v "Fred" "$say2"`;
echo subtract($a, $b) . PHP_EOL;

$say3 = "$a multiplied by $b equals";
	`say -v "Fred" "$say3"`;
echo multiply($a, $b) . PHP_EOL;

$say4 = "$a divided by $b equals"; 
	`say -v "Fred" "$say4"`;
echo divide($a, $b) . PHP_EOL;




	
	
	
	
	