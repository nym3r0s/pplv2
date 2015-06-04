<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'stein238';
$dbname = 'ppl';
$link = mysqli_connect($dbhost,$dbuser,$dbpass) or die('MySQL Connection Failed');

mysqli_select_db($link,$dbname);


//  redefining mysql_result

$row = NULL;
function mysql_result($result,$i,$field)
{
	// $result2 = clone $result;
	// var_dump($result);
	global $row;
	if($row==NULL)
	$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
	echo($i." ".$field);
	echo("<br><pre> ");
	// var_dump($row);
	echo("</pre> <br>");
	// var_dump($i);
	var_dump($row[$i][$field]);
	// die();
	// return $row[$i][$field];
}
?>
