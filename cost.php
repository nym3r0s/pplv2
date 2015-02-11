<?php
require './includes/dbconfig.php';

$cost = 0;

for($id = 1000; $id < 1215; $id++){

    $runs = 0; $average = 0; $strike = 70 ; $wickets = 0; $economy = 10;  $catches = 0; $stumpings = 0;

    $query = 'SELECT `type` FROM `players` WHERE playerId='.$id.'';
    $res = mysql_query($query);
    $type = mysql_result($res,0,"type");

    $query = 'SELECT `matches` FROM `players` WHERE playerId='.$id.'';
    $res = mysql_query($query);
    $matches = mysql_result($res,0,"matches");

    if($type == "Batsman" || $type == "All-Rounder"){
    $query = 'SELECT `average` FROM `batting` WHERE playerId='.$id.'';
    $res = mysql_query($query);
    $average =    mysql_result($res,0,"average");

    $query = 'SELECT `runs` FROM `batting` WHERE playerId='.$id.'';
    $res = mysql_query($query);
    $runs =    mysql_result($res,0,"runs");

    $query = 'SELECT `strikeRate` FROM `batting` WHERE playerId='.$id.'';
    $res = mysql_query($query);
    $strike = mysql_result($res,0,"strikeRate");

    $cost = 600 + $matches + $runs/20 + $average*10 + ($strike-60)*4;
    }

    if($type != "Batsman"){
    $query = 'SELECT `wickets` FROM `bowling` WHERE playerId='.$id.'';
    $res = mysql_query($query);
    $wickets = mysql_result($res,0,"wickets");

    $query = 'SELECT `economy` FROM `bowling` WHERE playerId='.$id.'';
    $res = mysql_query($query);
    $economy = mysql_result($res,0,"economy");

    if($type == "All-rounder")
        $cost = $cost + $wickets*3 + (10-$economy)*20;
    else
        $cost = 850 + $matches + $wickets*3 + (10-$economy)*20;
    }

    $query = 'SELECT `catches` FROM `fielding` WHERE playerId='.$id.'';
    $res = mysql_query($query);
    $catches = mysql_result($res,0,"catches");

    $query = 'SELECT `stumpings` FROM `fielding` WHERE playerId='.$id.'';
    $res = mysql_query($query);
    $stumpings = mysql_result($res,0,"stumpings");

    $cost =$cost + $catches/2 + $stumpings*3;

    $roundoff = $cost%100;
    if($roundoff < 25)
        $cost = $cost - $roundoff;
    else if($roundoff < 75)
        $cost = $cost - $roundoff + 50;
    else
        $cost = $cost - $roundoff +100;

    if($cost > 1700)$cost = 1700;
    else if($cost < 600) $cost = 600;
    $cost = intval($cost) * 1000;

    $query = 'UPDATE `playerData` SET cost = '.$cost.' WHERE playerId='.$id.'';
    mysql_query($query);
}
?>
