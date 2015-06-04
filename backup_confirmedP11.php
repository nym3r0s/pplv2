<?php
require './includes/dbconfig.php';

$truncate = 'truncate table confirmedP11_back';
mysqli_query($link,$truncate);  
$insert_query = "INSERT confirmedP11_back SELECT * FROM ppl.confirmedP11";
mysqli_query($link,$insert_query);

?>
