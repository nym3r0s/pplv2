<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'stein238';
$dbname = 'ppl';
mysql_connect($dbhost,$dbuser,$dbpass) or die('MySQL Connection Failed');
mysql_select_db($dbname);

?>
