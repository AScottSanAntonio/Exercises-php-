<?php  
$filename = 'contacts.txt';
$handle = fopen($filename, 'r');
$contents = fread($handle, filesize($filename));

//echo $contents;

fclose($handle);

$contactList = [];

array_unshift($contactList, $contents);
//print_r($contactList);

$menu = "1. View Contacts
2. Add new Contacts
3. Search a Contact
4. Delete an existing Contact
5. Exit
-Press x to exit a munu-\n";

fwrite(STDOUT, $menu);

//searches contacts
function MenuNavigate {
$operate = trim(fgets(STDIN));
if($operate === '1'){
	print_r($contactList);
} elseif ($operate === '2'){
	$contacts = 'contacts.txt';
	$contacthandle = fopen($filename, 'a+');
	$new = trim(fgets(STDIN));
	file_put_contents($contacts, $new, FILE_APPEND);
	fclose($contacthandle);
} 
if ($operate === 'x'){
	echo "going back";
}
}

$filename = 'contacts.txt';
$handle = fopen($filename, 'r');
$contents = fread($handle, filesize($filename));

echo "$contents\n";

fclose($handle);

