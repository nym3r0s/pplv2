<?php
session_start();
require './../includes/dbconfig.php';
$user = mysql_real_escape_string($_SESSION['user']);
if(!isset($user))
{
    header('Location: ./../login.php');
}

$userQuery = "SELECT * FROM userData WHERE userId1='$user' or userId2='$user' ; ";
$userResult = mysql_query($userQuery);

if(isset($userResult))
{
    $userBalance = mysql_result($userResult,0,"actualBalance");
    $userTeamId  = mysql_result($userResult,0,"teamId");
    $userP11     = mysql_result($userResult,0,"p11");
}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PPL'15</title>
    <!-- Jquery     -->
    <script src="./../includes/jquery-2.1.1.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="../includes/css/bootstrap.css" rel="stylesheet">
    <link href="../includes/css/common.css" rel="stylesheet">

    <!-- CSS styles  -->
    <link href="./leaderboardStyle.css" rel="stylesheet">

    <!-- Adding the Appropriate JS file  -->
    <script src="./../includes/datatable.js"></script>
    <script src="./leaderboard.js"></script>
    <script> var yourId = <? echo $user; ?>;</script>
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
            <li class="active"><a href="../leaderboard/leaderboard.php">Leaderboard</a></li>
            <li><a href="../wclive/wclive.php">WCLive</a></li>
            <li><a href="../analysis/analysis.php">Analysis</a></li>
            <li><a href="../instructions/instructions.php">Instructions</a></li>
            </ul>
            <div class="navbar-header navbar-right">
                <a href="./../logout.php">
                    <div class="navbar-text navbar-right">Logout</div>
                </a>
            </div>
        </div>
      </div>
    </nav>

        <div id="theHeading"><h4><b>Leaderboard</b></h4></div>

    <div class="table-responsive">
        <table id="sort" class="table">
            <thead>
              <tr>
                <th>Rank</th>
                <th>Pragyan ID</th>
                <th>Pragyan ID</th>
                <th>Score</th>
              </tr>
            </thead>
            <tbody id="rankingList">
            </tbody>
        </table>
    </div>


    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="footer text-center">
            <p>Developed by Delta Force.</p>
        </div>
    </nav>
    </body>
</html>
