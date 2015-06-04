<?php

session_start();
require './../includes/dbconfig.php';


$roundNum = $_POST['rno'];
$user = $_SESSION['admin'];

//echo('playerID: '.$playerId);

if(!isset($user))
{
    header('Location: ./login.php');
}

// Deleting existing table if exists and Creating a table for the particular round

$deleteTableQuery = "DROP TABLE pplRound_".$roundNum.";";
$createTableQuery = "CREATE TABLE IF NOT EXISTS `pplRound_".$roundNum."` (  `teamId` bigint(20) NOT NULL,  `playerId` bigint(20) NOT NULL,`form` bigint(20) NOT NULL, `confidence` bigint(20) NOT NULL);";

$deleteTable = mysqli_query($link,$deleteTableQuery);
$createTable = mysqli_query($link,$createTableQuery);

$tableName = "pplRound_".$roundNum;

// Selecting all the teams that have registered

$teamQuery = 'SELECT * FROM userData';
$teamResult = mysqli_query($link,$teamQuery);

$teams = [];

for($i=0;$i<mysqli_num_rows($teamResult);$i++)
{
    $teams[] = 
mysql_result($teamResult,$i,"teamId");
}

foreach($teams as $teamId)
{
    $teamPlaying11Query = "SELECT * FROM userP11 where teamId=".$teamId.";";
    $teamPlaying11Result = mysqli_query($link,$teamPlaying11Query);

    if(mysqli_num_rows($teamPlaying11Result)<11)
    {
        continue;
    }

    else
    {
        for($i=0;$i<mysqli_num_rows($teamPlaying11Result);$i++)
        {
            $playerId = 
mysql_result($teamPlaying11Result,$i,"playerId");

            $playerDetailsQuery= "SELECT * FROM userSquad WHERE playerId=".$playerId." AND teamId=".$teamId.";";
            $playerDetailsResult = mysqli_query($link,$playerDetailsQuery);
            $playerForm = 
mysql_result($playerDetailsResult,0,"form");
            $playerConfidence = 
mysql_result($playerDetailsResult,0,"confidence");

            $roundInsertQuery = "INSERT INTO ".$tableName." VALUES ('".$teamId."','".$playerId."','".$playerForm."','".$playerConfidence."');";
            echo($roundInsertQuery);
            $roundInsertResult = mysqli_query($link,$roundInsertQuery);
        }
    }

}

