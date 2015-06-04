<?php
session_start();
require './../includes/dbconfig.php';
$user = 
mysqli_real_escape_string($link,$_SESSION['user']);
if(!isset($user))
{
    header('Location: ./../login.php');
}

$userQuery = "SELECT * FROM userData WHERE userId1='$user' or userId2='$user' ; ";
$userResult = mysqli_query($link,$userQuery);

if(isset($userResult))
{
    $userBalance = 
mysql_result($userResult,0,"actualBalance");
    $userTeamId  = 
mysql_result($userResult,0,"teamId");
    $userP11     = 
mysql_result($userResult,0,"p11");
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
    <script src="../includes/bootstrap.js"></script>

    <!-- CSS styles  -->
    <link href="./leaderboardStyle.css" rel="stylesheet">

    <!-- Adding the Appropriate JS file  -->
    <script> var yourId = <?php echo $user; ?>;</script>
<!--    <script src="./../includes/datatable.js"></script>-->
    <script src="./leaderboard.js"></script>
  </head>

  <body>
    <nav class="header navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="../home/">PPL '15</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../transfers/">Transfers</a></li>
            <li><a href="../matchday/">Matchday</a></li>
            <li class="active"><a href="../leaderboard/">Leaderboard</a></li>
            <li><a href="../wclive/">WCLive</a></li>
            <li><a href="../instructions/">Instructions</a></li>
            </ul>
            <div class="navbar-header navbar-right">
                <div class="dropdown" style="margin-top:10%">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    <b>PID :</b> <?php echo $user ?>
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li class="drop" role="presentation"><a role="menuitem" tabindex="-1" href="../analysis/">Analysis</a></li>
                    <li class="drop" role="presentation"><a role="menuitem" tabindex="-1" href="./../contact/">Contact</a></li>
                    <li class="drop" role="presentation" class="divider"></li>
                    <li class="drop" role="presentation"><a role="menuitem" tabindex="-1" href="./../logout.php">Logout</a></li>
                </ul>
                </div>
            </div>
      </div>
      </div>
    </nav>

        <div id="theHeading"><h3><b>Leaderboard</b></h3></div>

    <div class="table-responsive">
        <table id="sort" class="table">
            <thead>
              <tr>
                <th>Rank</th>
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
            <p>Developed by <b>Delta Force.</b></p>
        </div>
    </nav>
    </body>
</html>
