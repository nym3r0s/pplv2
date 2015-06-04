<?php
session_start();
require './../includes/dbconfig.php';

$user = 
mysqli_real_escape_string($link,$_SESSION['user']);


if(!isset($user))
{
    header('Location: ./../login.php');
}

// Getting User Balance and data.

$userQuery = "SELECT * FROM userData WHERE userId1='$user' or userId2='$user' ; ";
$userResult = mysqli_query($link,$userQuery);

if(isset($userResult))
{
    $userBalance = 
mysql_result($userResult,0,"actualBalance");
    $userTeamId  = 
mysql_result($userResult,0,"teamId");
}

$squadQuery = "SELECT * FROM confirmedSquad WHERE teamId=$userTeamId";
//echo($squadQuery);
$squadResult = mysqli_query($link,$squadQuery);

$jsonarray = [];

for($i=0;$i<mysqli_num_rows($squadResult);$i++)
{
    $playerId    = 
mysql_result($squadResult,$i,"playerId");

    $playerQuery = "SELECT * FROM players WHERE playerId=$playerId";
    $playerResult = mysqli_query($link,$playerQuery);


    $playerName    = 
mysql_result($playerResult,0,"name");
    $playerCountry = 
mysql_result($playerResult,0,"country");
    $playerType    = 
mysql_result($playerResult,0,"type");
    $playerCaptain = 
mysql_result($playerResult,0,"captain");

    $pcostquery = "SELECT * FROM playerData where playerId=$playerId";
    $pcostresult = mysqli_query($link,$pcostquery);
    $pcost = 
mysql_result($pcostresult,0,"cost");

        if(strpos($playerType,'tsman')) $pclass = 'batsman';
        else if(strpos($playerType,'keeper')) $pclass = 'wkeeper';
        else if(strpos($playerType,'Rounder')) $pclass = 'rounder';
        else if(strpos($playerType,'Bowler')) $pclass = 'bowler';

        if($playerCaptain!="") $pclass = $pclass." captain";


    $obj['playerId'] = $playerId;
    $obj['playerName'] = $playerName;
    $obj['playerCountry'] = $playerCountry;
    $obj['playerType'] = $playerType;
    $obj['playerCaptain'] = $playerCaptain;
    $obj['playerClass'] = $pclass;
    $obj['playerCost'] = $pcost;
//    var_dump($obj);
    $jsonarray[] = $obj;
}

$jsonString = json_encode($jsonarray,JSON_PRETTY_PRINT);
//echo("Number of results ".mysqli_num_rows($playerResult)." <br>");
echo($jsonString);

?>
