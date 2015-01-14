<?php
session_start();
require './../includes/dbconfig.php';


$playerId = $_POST['req'];
$user = $_SESSION['user'];

//echo($playerId);

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
//    echo('teamid: '.$userTeamId);
//    echo('balance: '.$userBalance);
}

else
{
    echo("Couldnt get user data");
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
    echo("Couldnt get player data");
}

$playernumquery = "SELECT * FROM userSquad where teamId=$userTeamId";
$playernum = mysql_num_rows(mysql_query($playernumquery));

if((($userBalance - $playerCost)>=0)&&($playernum<16))
{
    $transferQuery = "INSERT INTO userSquad VALUES ('$userTeamId','$playerId','$playerForm','$playerConfidence'); ";
    $updateBalance = $userBalance - $playerCost;
    $balanceQuery = "UPDATE userData SET money = $updateBalance WHERE teamId=$userTeamId ;";

    $transferresult = mysql_query($transferQuery);
    $balanceresult = mysql_query($balanceQuery);

}

?>
