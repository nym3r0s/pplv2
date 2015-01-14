<?php
session_start();
require './../includes/dbconfig.php';

$user = $_SESSION['user'];


if(!isset($user))
{
    header('Location: ./../login.php');
}

// Getting User Balance and data.

$userQuery = "SELECT * FROM userData WHERE userId1='$user' or userId2='$user' ; ";
$userResult = mysql_query($userQuery);

if(isset($userResult))
{
    $userBalance = mysql_result($userResult,0,"money");
    $userTeamId  = mysql_result($userResult,0,"teamId");
}


$query = "SELECT * from userSquad WHERE teamId=$userTeamId;";
$result = mysql_query($query);

$playerList = array();

for($i=0;$i<mysql_num_rows($result);$i++)
{
    $playerList[] = mysql_result($result,$i,"playerId");
}

$playerQuery = "SELECT * FROM players";
$playerResult = mysql_query($playerQuery);

for($i=0;$i<mysql_num_rows($playerResult);$i++)
{
    $playerId    = mysql_result($playerResult,$i,"playerId");
    $playerName    = mysql_result($playerResult,$i,"name");
    $playerCountry = mysql_result($playerResult,$i,"country");
    $playerType    = mysql_result($playerResult,$i,"type");
    $playerCaptain = mysql_result($playerResult,$i,"captain");

    $pcostquery = "SELECT * FROM playerData where playerId=$playerId";
    $pcostresult = mysql_query($pcostquery);
    $pcost = mysql_result($pcostresult,0,"cost");

    if(!in_array($playerId,$playerList))
    {

        if(strpos($playerType,'tsman')) $pclass = 'batsman';
        else if(strpos($playerType,'keeper')) $pclass = 'wkeeper';
        else if(strpos($playerType,'Rounder')) $pclass = 'rounder';
        else if(strpos($playerType,'Bowler')) $pclass = 'bowler';

        if($playerCaptain!="") $pclass = $pclass." captain";



echo('<div id="'.$playerId.'" class="player row '.$pclass.'"><div class="col-sm-4">'.$playerName.'</div><div class="col-sm-3">'.$playerCountry.'</div><div class="col-sm-3">'.$playerType.'</div><div class="col-sm-1">'.$pcost.'</div><div class="col-sm-1">'.$playerCaptain."</div></div>") ;
    }
}

?>
