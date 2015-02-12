<?php
require './includes/dbconfig.php';

$truncate = 'truncate table confirmedP11_back';
mysql_query($truncate);  
$insert_query = "INSERT confirmedP11_back SELECT * FROM ppl.confirmedP11";
mysql_query($insert_query);

?>
