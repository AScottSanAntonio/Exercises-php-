<?php

 // Converts array into list n1, n2, ..., and n3
 function humanizedList($array) {
   // Your solution goes here!
 }

 // List of famous peeps
 $physicistsString = 'Gordon Freeman, Samantha Carter, Sheldon Cooper, Quinn Mallory, Bruce Banner, and Tony Stark';

 // TODO: Convert the string into an array
 $physicistsArray = [];
 $physicistsArray = explode(', ', $physicistsString);
 sort($physicistsArray);


 $physicistsArray2 = implode(', ', $physicistsArray);

 // Humanize that list
 $famousFakePhysicists = humanizedList($physicistsArray);

 // Output sentence
 echo "Some of the most famous fictional theoretical physicists are {$physicistsArray2}.\n";