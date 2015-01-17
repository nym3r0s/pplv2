<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'ppl';
mysql_connect($dbhost,$dbuser,$dbpass) or die('MySQL Connection Failed');
mysql_select_db($dbname);

$id = 1000;
$cost = 0;

//Base point(850) + No. of matches player + Average*3 + (Strike rate-50)*4 + Wickets + (10-economy)*20 + catches/2 + stumpings*2

for($id; $id<1420; $id++){
	
	$query = 'SELECT `matches` FROM `players` WHERE playerId='.$id.'';
	$res = mysql_query($query);
	$matches = mysql_result($res,0,"matches");
	
	$query = 'SELECT `average` FROM `batting` WHERE playerId='.$id.'';
	$res = mysql_query($query);
	$average =	mysql_result($res,0,"average");
	
	$query = 'SELECT `strikeRate` FROM `batting` WHERE playerId='.$id.'';
	$res = mysql_query($query);
	$strike = mysql_result($res,0,"strikeRate");

	$query = 'SELECT `wickets` FROM `bowling` WHERE playerId='.$id.'';
	$res = mysql_query($query);
	$wickets = mysql_result($res,0,"wickets");

	$query = 'SELECT `economy` FROM `bowling` WHERE playerId='.$id.'';
	$res = mysql_query($query);
	$economy = mysql_result($res,0,"economy");

	$query = 'SELECT `catches` FROM `fielding` WHERE playerId='.$id.'';
	$res = mysql_query($query);
	$catches = mysql_result($res,0,"catches");

	$query = 'SELECT `stumpings` FROM `fielding` WHERE playerId='.$id.'';
	$res = mysql_query($query);
	$stumpings = mysql_result($res,0,"stumpings");

	$cost = 900 + $matches + $average*3 + ($strike-50)*4 + $wickets + (10-$economy)*20 + $catches/2 + $stumpings*3;
	
	$roundoff = $cost%100;
	if($roundoff < 25)
		$cost = $cost - $roundoff;
	else if($roundoff < 75)
		$cost = $cost - $roundoff + 50;
	else 
		$cost = $cost - $roundoff +100;
	
	if($cost > 1650)$cost = 1650;
	
	$cost = intval($cost) * 1000;
	
	$query = 'INSERT INTO `cost`(`playerId`, `Cost`) VALUES ('.$id.','.$cost.')';
	mysql_query($query);
}
?>
