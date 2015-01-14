<?php
session_start();
require './../includes/dbconfig.php';


$playerId = $_POST['req'];
$user = $_SESSION['user'];

//echo('playerID: '.$playerId);

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

// Getting player details.

$playerQuery = "SELECT * FROM playerData WHERE playerId='$playerId' ;";
$playerResult = mysql_query($playerQuery);


if(isset($playerResult))
{
    $playerCost       = mysql_result($playerResult,0,"cost");
    $playerForm       = mysql_result($playerResult,0,"form");
    $playerConfidence = mysql_result($playerResult,0,"confidence");

}

else
{
    echo("player result not found");
}

    $transferQuery = "DELETE FROM userSquad WHERE teamId=$userTeamId AND playerId = $playerId; ";
    $playing11Query= "DELETE FROM userP11 WHERE teamId=$userTeamId AND playerId = $playerId; ";

    $updateBalance = $userBalance + $playerCost;
    $balanceQuery = "UPDATE userData SET money = $updateBalance WHERE teamId=$userTeamId ;";

    mysql_query($transferQuery);
    mysql_query($playing11Query);
    mysql_query($balanceQuery);

//    echo($transferQuery.'  '.$balanceQuery);

?>
