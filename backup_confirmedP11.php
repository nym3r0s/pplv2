<?php
require './includes/dbconfig.php';

$insert_query = "INSERT confirmedP11_back SELECT * FROM ppl.confirmedP11";
mysql_query($insert_query);

?>