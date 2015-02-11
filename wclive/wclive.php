<?php
session_start();
require './../includes/dbconfig.php';
$user = $_SESSION['user'];
if(!isset($user))
{
    header('Location: ./../login.php');
}
?>
<html>
  <head>
    <title>PPL'15</title>
    <script src="./../includes/jquery-2.1.1.min.js"></script>
    <link rel="stylesheet" href="./../includes/css/bootstrap.css">
    <link rel="stylesheet" href="./../includes/css/common.css">
    <script src="../includes/bootstrap.js"></script>

    <link rel="stylesheet" href="./wclive.css">
    <script src="./wclive.js"></script>
  </head>
  <body>
    <nav class="header navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="../home/home.php">PPL '15</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../transfers/transfers.php">Transfers</a></li>
            <li><a href="../matchday/matchday.php">Matchday</a></li>
            <li><a href="../leaderboard/leaderboard.php">Leaderboard</a></li>
            <li class="active"><a href="../wclive/wclive.php">WCLive</a></li>
            <li><a href="../instructions/instructions.php">Instructions</a></li>
            </ul>
            <div class="navbar-header navbar-right">
                <div class="dropdown" style="margin-top:10%">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    <b>PID :</b> <?php echo $user ?>
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li class="drop" role="presentation"><a role="menuitem" tabindex="-1" href="../analysis/analysis.php">Analysis</a></li>
                    <li class="drop" role="presentation"><a role="menuitem" tabindex="-1" href="./../contact/contact.php">Contact</a></li>
                    <li class="drop" role="presentation" class="divider"></li>
                    <li class="drop" role="presentation"><a role="menuitem" tabindex="-1" href="./../logout.php">Logout</a></li>
                </ul>
                </div>
            </div>
      </div>
      </div>
    </nav>

    <h3 id="matchBetween"><center>Match 1: New Zealand v Pakistan</center></h3>
    <h3 id="matchWinner"><center>New Zealand won by 119 runs</center></h3>
    <div id="choices">
        <button id="choiceBatting" class="btn">Batting</button>
        <button id="choiceBowling" class="btn">Bowling</button>
    </div>

    <div class="data-container">
    <div class="table-responsive">
    <table id="battingTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Batsman</th>
                <th>Wicket Details</th>
                <th>Runs</th>
                <th>Fours</th>
                <th>Sixes</th>
                <th>Strike Rate</th>
            </tr>
        </thead>
        <tbody>
            <?php
    $battingDetailsQuery = "SELECT * FROM displayBatting";
    $battingDetailsResult = mysql_query($battingDetailsQuery);
//    var_dump($battingDetailsResult);
    for($i=0;$i<mysql_num_rows($battingDetailsResult);$i++)
    {
        echo("<tr>");
        $batsman        = mysql_result($battingDetailsResult,$i,"playerName");
        $wicketDetails  = mysql_result($battingDetailsResult,$i,"wicketInfo");
        $runs           = mysql_result($battingDetailsResult,$i,"runs");
        $fours          = mysql_result($battingDetailsResult,$i,"four");
        $six            = mysql_result($battingDetailsResult,$i,"six");
        $srate          = mysql_result($battingDetailsResult,$i,"strikeRate");
        echo("<td>$batsman</td>");
        echo("<td>$wicketDetails</td>");
        echo("<td>$runs</td>");
        echo("<td>$fours</td>");
        echo("<td>$six</td>");
        echo("<td>$srate</td>");
//        $batsman = mysql_result($battingDetailsResult,$i,"playerName");
        echo("</tr>");
    }
            ?>
    </tbody>
    </table>

    <table id="bowlingTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Bowler</th>
                <th>Overs</th>
                <th>Maidens</th>
                <th>Wickets</th>
                <th>Economy</th>
            </tr>
        </thead>
        <tbody>

            <?php
    $bowlingDetailsQuery = "SELECT * FROM displayBowling";
    $bowlingDetailsResult = mysql_query($bowlingDetailsQuery);
//    var_dump($battingDetailsResult);
    for($i=0;$i<mysql_num_rows($bowlingDetailsResult);$i++)
    {
        echo("<tr>");
        $bowler   = mysql_result($bowlingDetailsResult,$i,"playerName");
        $overs    = mysql_result($bowlingDetailsResult,$i,"overs");
        $maidens  = mysql_result($bowlingDetailsResult,$i,"maidens");
        $wickets  = mysql_result($bowlingDetailsResult,$i,"wickets");
        $economy  = mysql_result($bowlingDetailsResult,$i,"economy");
        echo("<td>$bowler</td>");
        echo("<td>$overs</td>");
        echo("<td>$maidens</td>");
        echo("<td>$wickets</td>");
        echo("<td>$economy</td>");
//        $batsman = mysql_result($battingDetailsResult,$i,"playerName");
        echo("</tr>");
    }
            ?>


        </tbody>
    </table>
    </div>
    </div>

    <nav class=" footer navbar navbar-default navbar-fixed-bottom">
        <div class="footer">
            <p>Developed by <b>Delta Force.</b></p>
        </div>
    </nav>

  </body>
</html>
