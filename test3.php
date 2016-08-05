<?php 
$fn = "contacts.txt"; 
$file = fopen($fn, "a+"); 
$size = filesize($fn); 

if($_POST['addition']) fwrite($file, $_POST['addition']); 

$text = fread($file, $size); 
fclose($file); 
?>