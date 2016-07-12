<?php

function parseContacts($filename)
{
	$filename = 'contacts.txt';
$handle = fopen($filename, 'r');
$contents = fread($handle, filesize($filename));
$contentsArray = explode("\n", $contents);
fclose($handle);
    $contacts = array();

    

    return $contacts;
}

var_dump(parseContacts('contacts.txt'));
