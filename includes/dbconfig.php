<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'ppl';
mysql_connect($dbhost,$dbuser,$dbpass) or die('MySQL Connection Failed');
mysql_select_db($dbname);

?>
