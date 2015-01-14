<?php
session_start();
require './../includes/dbconfig.php';
$user = $_SESSION['user'];
if(!isset($user))
{
    header('Location: ./../login.php');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PPL'15</title>

    <!-- Bootstrap core CSS -->
    <link href="../includes/css/bootstrap.css" rel="stylesheet">
    <link href="../includes/css/common.css" rel="stylesheet">
  </head>
  
  <body>
	<nav class="header navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="">PPL '15</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../transfers/transfers.php">Transfers</a></li>
            <li class="active"><a href="../matchday/matchday.php">Matchday</a></li>
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
	
	<nav class="navbar navbar-default navbar-fixed-bottom">
		<div class="footer text-center">
			<p>Developed by Delta Force.</p>
		</div>
	</nav>
	</body>
</html>