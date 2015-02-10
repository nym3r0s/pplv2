<?php
require './../includes/dbconfig.php';


mysql_connect($dbhost,$dbuser,$dbpass) or die('MySQL Connection Failed');
mysql_select_db($dbname);

$sel_teamId_res = mysql_query("SELECT `teamId` FROM `userData` WHERE 1");

for($i = 0, $score = 0; $i < mysql_num_rows($sel_teamId_res); $i++, $score = 0){
    $teamId = mysql_result($sel_teamId_res,$i,"teamId");
    $sel_player = mysql_query("SELECT `playerId` FROM `confirmedP11` WHERE `teamId`='".$teamId."' ");

    for($j = 0; $j < mysql_num_rows($sel_player) ; $j++){
        $playerId = mysql_result($sel_player, $j , "playerId");
        $score_query = mysql_query("SELECT `roundOne` FROM `players` WHERE `playerId`='".$playerId."' ");
        $score = $score + mysql_result($score_query,0,"roundOne");
    }

    $update_query = "UPDATE `userData` SET `roundOneScore` = '".$score."' WHERE `teamId` ='".$teamId."' ";
    mysql_query($update_query);
    }
?>
