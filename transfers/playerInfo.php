<?php
session_start();
require './../includes/dbconfig.php';

//echo("done");

$playerId = $_POST['req'];
$user = $_SESSION['user'];

if(!isset($user))
{
    header('Location: ./../login.php');
}


$playerQuery = "SELECT * FROM players WHERE playerId=$playerId";
$batQuery    = "SELECT * FROM batting WHERE playerId=$playerId";
$bowlQuery   = "SELECT * FROM bowling WHERE playerId=$playerId";
$fieldQuery  = "SELECT * FROM fielding WHERE playerId=$playerId";
$dataQuery   = "SELECT * FROM playerData WHERE playerId=$playerId";


$playerResult = mysql_query($playerQuery);
$batResult    = mysql_query($batQuery);
$bowlResult   = mysql_query($bowlQuery);
$fieldResult  = mysql_query($fieldQuery);
$dataResult   = mysql_query($dataQuery);

//$player = mysql_result($Result,0,"");

// From players
$playerName     = mysql_result($playerResult,0,"name");
$playerCountry  = mysql_result($playerResult,0,"country");
$playerPhoto    = mysql_result($playerResult,0,"photoUrl");
$playerType     = mysql_result($playerResult,0,"type");
$playerMatches  = mysql_result($playerResult,0,"matches");
$playerCaptain  = mysql_result($playerResult,0,"captain");

// From playerData
$playerForm       = mysql_result($dataResult,0,"form");
$playerConfidence = mysql_result($dataResult,0,"confidence");
$playerCost       = mysql_result($dataResult,0,"cost");

// From batting
$playerRuns       = mysql_result($batResult,0,"runs");
$playerHighscore  = mysql_result($batResult,0,"highScore");
$playerAverage    = mysql_result($batResult,0,"average");
$playerStrikeRate = mysql_result($batResult,0,"strikeRate");
$playerHundred    = mysql_result($batResult,0,"hundred");
$playerFifty      = mysql_result($batResult,0,"fifty");

// From Bowling
$playerWickets = mysql_result($bowlResult,0,"wickets");
$playerBest = mysql_result($bowlResult,0,"best");
$playerBowlAverage = mysql_result($bowlResult,0,"average");
$playerEconomy = mysql_result($bowlResult,0,"economy");
$playerFour = mysql_result($bowlResult,0,"four");
$playerFive = mysql_result($bowlResult,0,"five");

// From fielding
$playerInnings   = mysql_result($fieldResult,0,"innings");
$playerCatches   = mysql_result($fieldResult,0,"catches");
$playerStumpings = mysql_result($fieldResult,0,"stumpings");

/*Starting to create HTML*/


echo('<div class="panel panel-default" id="playerProfile">');
    echo('<div class="panel-heading"><h3 class="panel-title">'.$playerName.'</h3></div>');
    echo('<div class="panel-body">');
        echo('<img class="img-circle" id="playerpic" src="'.$playerPhoto.'">');
//        echo('<div class="row"><div class="col-md-5"><b>'.''.'</b></div><div class="col-md-7">'..'</div></div><br>');
        echo('<br><br>');
        echo('<div class="row"><div class="col-md-5"><b>'.'Country'.'</b></div><div class="col-md-7">'.$playerCountry.'</div></div><br>');
        echo('<div class="row"><div class="col-md-5"><b>'.'Playing Role'.'</b></div><div class="col-md-7">'.$playerType.'</div></div><br>');
        echo('<div class="row"><div class="col-md-5"><b>'.'Matches'.'</b></div><div class="col-md-7">'.$playerMatches.'</div></div><br>');
        echo('<div class="row"><div class="col-md-3"><b>'.'Form'.'</b></div><div class="col-md-3">'.$playerForm.'</div>');
        echo('<div class="col-md-3"><b>'.'Confidence'.'</b></div><div class="col-md-3">'.$playerConfidence.'</div></div><br>');

if($playerCaptain != ""){    echo('<div class="row"><b>Captain</b></div><br>'); }
        echo('</div>');
echo('</div>');

echo('<div class="panel panel-default" id="playerStats">');

echo('<div id="battingStats">');
echo("<h5>Batting and Fielding</h5>");

echo('<table class="table table-striped table-hover table-bordered" id="battingTable">');
  echo('<thead>');
    echo('<tr>');
      echo('<th>Runs</th>');
      echo('<th>High Score</th>');
      echo('<th>Average</th>');
      echo('<th>Strike Rate</th>');
      echo('<th>Hundreds</th>');
      echo('<th>Fifties</th>');
      echo('<th>Catches</th>');
      echo('<th>Stumpings</th>');
    echo('</tr>');
  echo('</thead>');
  echo('<tbody>');
    echo('<tr>');
      echo('<td>'.$playerRuns.'</td>');
      echo('<td>'.$playerHighscore.'</td>');
      echo('<td>'.$playerAverage.'</td>');
      echo('<td>'.$playerStrikeRate.'</td>');
      echo('<td>'.$playerHundred.'</td>');
      echo('<td>'.$playerFifty.'</td>');
      echo('<td>'.$playerCatches.'</td>');
      echo('<td>'.$playerStumpings.'</td>');
    echo('</tr>');
  echo('</tbody>');
echo('</table>');


echo('</div>');

echo('<div id="bowlingStats">');
echo("<h5>Bowling</h5>");

echo('<table class="table table-striped table-hover table-bordered" id="bowlingTable">');
  echo('<thead>');
    echo('<tr>');
      echo('<th>Wickets</th>');
      echo('<th>Best</th>');
      echo('<th>Average</th>');
      echo('<th>Economy</th>');
      echo('<th>Four WH</th>');
      echo('<th>Five WH</th>');
    echo('</tr>');
  echo('</thead>');
  echo('<tbody>');
    echo('<tr>');
      echo('<td>'.$playerWickets.'</td>');
      echo('<td>'.$playerBest.'</td>');
      echo('<td>'.$playerBowlAverage.'</td>');
      echo('<td>'.$playerEconomy.'</td>');
      echo('<td>'.$playerFour.'</td>');
      echo('<td>'.$playerFive.'</td>');
    echo('</tr>');
  echo('</tbody>');
echo('</table>');

echo('</div>');
echo('</div>');

