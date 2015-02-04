<?php
session_start();
require './../includes/dbconfig.php';
$user = mysql_real_escape_string($_SESSION['user']);
if(!isset($user))
{
    header('Location: ./../login.php');
}

$rankingQuery = "SELECT * FROM userData ORDER BY score DESC";
$rankingResult = mysql_query($rankingQuery);

$jsonArray = [];

for($i=0;$i<mysql_num_rows($rankingResult);$i++)
{
    $obj['teamId'] = mysql_result($rankingResult,$i,"teamId");
    $obj['userId1'] = mysql_result($rankingResult,$i,"userId1");
    $obj['userId2'] = mysql_result($rankingResult,$i,"userId2");
    $obj['score'] = mysql_result($rankingResult,$i,"score");

    $jsonArray[] = $obj;

}

$jsonString = json_encode($jsonArray,JSON_PRETTY_PRINT);
echo($jsonString);

