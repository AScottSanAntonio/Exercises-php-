<?php  
$nouns = ['Paladin','Rogue','Barbarian','Cleric','Ranger','Shaman','Wizard','Gunslinger','Necromancer','Summoner'];

$adjectives = ['Lawful Good','Lawful Neutral','Lawful Evil','True Good','True Neutral','True Evil','Chaotic Good','Chaotic Neutral','Chaotic Evil','Chaotic Stupid'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>DnD Character Generator</title>
</head>
<body>
	<h1>DnD Character Creation</h1>
	<div id = "display">
		<?php $characters = array_rand($nouns, 1); ?>
		<?php $alignments = array_rand($adjectives, 1); ?>
		<ul>
			<li><?php $alignment; ?></li>
			<li><?php $characters; ?></li>
		</ul>
	</div>



</body>
</html>