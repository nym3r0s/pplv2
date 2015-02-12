<?php
require './includes/dbconfig.php';

$query = "SELECT `name` FROM `players` WHERE 1";
$res = mysql_query($query);

for($i = 0; $i < mysql_num_rows($res); $i++){
		$player[$i] = mysql_result($res,$i,"name");
	}

$sum = 0;

for($i = 0; $i < mysql_num_rows($res); $i++){

	$player_i = explode(" ",$player[$i]);
	$pos_i = substr_count($player[$i],' ');

	for($j = 0; $j < mysql_num_rows($res), $i != $j; $j++){

		$player_j = explode(" ",$player[$j]);
		$pos_j = substr_count($player[$j],' ');

		if($player_j[$pos_j] == $player_i[$pos_i])
			echo $player[$i].' '.$player[$j].'<br /><br />';
		}
	}
?>
