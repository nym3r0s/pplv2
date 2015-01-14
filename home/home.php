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
    <link rel="stylesheet" href="./../includes/css/bootstrap.css">
    <link rel="stylesheet" href="./../includes/css/common.css">
    <script src="./../includes/jquery-2.1.1.min.js"></script>
  </head>
  <body>
	<nav class="header navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href=".">PPL '15</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../transfers/transfers.php">Transfers</a></li>
            <li><a href="../matchday/matchday.php">Matchday</a></li>
            <li><a href="../leaderboard/leaderboard.php">Leaderboard</a></li>
			<li><a href="../wclive/wclive.php">WCLive</a></li>
            <li><a href="../analysis/analysis.php">Analysis</a></li>
            </ul>
					
            <div class="navbar-header navbar-right">
                <a href="./../logout.php">
                    <div class="navbar-text navbar-right">Logout</div>
                </a>
            </div>
		</div>
      </div>
	</nav>
	
      <?php

        $query = "SELECT * FROM userData WHERE userId1=$user or userId2=$user ;";
        $result = mysql_query($query);

        if(isset($result)&&(mysql_num_rows($result)>0))
        {
            $teamid = mysql_result($result,0,"teamId");
            $score  = mysql_result($result,0,"score");
            $money   = mysql_result($result,0,"money");
        }
        else
        {
            echo('No such team / player not registered ');
        }
        ?>

	<center>
		<h2>Welcome Back</h2>
		<h3>Team ID: <?php echo($teamid); ?></h3>
		<h3>Player ID: <?php echo($user); ?></h3>
		<h3>Money : <?php echo($money); ?></h3>
		<h4>Score: <? echo($score); ?></h4>
	</center>

  	<nav class=" footer navbar navbar-default navbar-fixed-bottom">
		<div class="footer">
			<p>Developed by Delta Force</p>
		</div>
	</nav>

  </body>
</html>
