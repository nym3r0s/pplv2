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
    $transferNum = 
mysql_result($userResult,0,"transferNum");
echo($transferNum);
}
//$oldSquadQuery = "SELECT * FROM confirmedSquad where teamId='".$userTeamId."';";
//$oldSquadResult = mysqli_query($link,$oldSquadQuery);
//$oldids = array();
//
//for($i=0;$i<mysqli_num_rows($oldSquadResult);$i++)
//{
//    $oldids[] = 
mysql_result($oldSquadResult,$i,"playerId");
//}
//
//
//$newSquadQuery = "SELECT * FROM userSquad where teamId='".$userTeamId."';";
//$newSquadResult = mysqli_query($link,$newSquadQuery);
//$newids = array();
//
//for($i=0;$i<mysqli_num_rows($newSquadResult);$i++)
//{
//    $newids[] = 
mysql_result($newSquadResult,$i,"playerId");
//}
//
//$numchanges = 0;
//for($i=0;$i<mysqli_num_rows($newSquadResult);$i++)
//{
//    if(!in_array($newids[$i],$oldids))
//    {
//        $numchanges++;
//    }
//}

//echo('<h5 class="col-md-6">Transfers Remaining: '.$transferNum.'</h5>');
//echo('<h5 class="col-md-6">Changes: '.$numchanges.'</h5>');
