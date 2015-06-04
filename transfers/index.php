<?php
session_start();
require './../includes/dbconfig.php';
$user = 
mysqli_real_escape_string($link,$_SESSION['user']);
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

    <script src="./../includes/jquery-2.1.1.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="../includes/css/bootstrap.css" rel="stylesheet">
    <link href="../includes/css/common.css" rel="stylesheet">
    <script src="../includes/bootstrap.js"></script>

    <link rel="stylesheet" href="./transferstyle.css">
    <script src="./transferscript.js"></script>
    <script src="./../includes/toaster.js"></script>
<!--    <script src="./../includes/datatable.js"></script>-->
    </head>

  <body>
    <nav class="header navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="../home/">PPL '15</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="../transfers/">Transfers</a></li>
            <li><a href="../matchday/">Matchday</a></li>
            <li><a href="../leaderboard/">Leaderboard</a></li>
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
    <marquee id="theMarquee" scrollamount="10" style="position:absolute;top:10%;width:50%;left:25%;">Please select your squad and confirm your playing 11 before 00:00 hrs. Enjoy PPL 15! </marquee>
<!-- Nav  Ends here-->
    <div class="transferDetails">
        <div id="playerBalance"></div>
        <div id="transferBalance"></div>
    </div>

    <div id="switches">
        <div class="btn-group" role="group" aria-label="...">
            <div class="btn-group" role="group">
            <button type="button" id="batsman" class="btn btn-default btn-success">Batsman</button>
            </div>
            <div class="btn-group" role="group">
            <button type="button" id="bowler" class="btn btn-default btn-success">Bowler</button>
            </div>
            <div class="btn-group" role="group">
            <button type="button" id="rounder" class="btn btn-default btn-success">All-rounder</button>
            </div>
            <div class="btn-group" role="group">
            <button type="button" id="wkeeper" class="btn btn-default btn-success">Wicket Keeper</button>
            </div>
            <div class="btn-group" role="group">
            <button type="button" id="captain" class="btn btn-default btn-success">Captain</button>
            </div>
        </div>
    </div>

    <div id="playerList">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                   <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Role</th>
                    <th>Price</th>
                   </tr>
                </thead>
                <tbody id="playerListTable">

                </tbody>
            </table>
        </div>
    </div>

    <div id="userSquad">
        <div class="table-responsive">
            <table id="sort" class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Role</th>
                    <th>Price</th>
                  </tr>
                </thead>
                <tbody id="userSquadTable">
                </tbody>
            </table>
        </div>
    </div>

<!--    Progress Bar -->

    <div class="progress active" id="progbardiv">
        <div class="progress-bar" id="progbar"></div>
    </div>
<!-- Modal here -->
    <div id="playerInfo">
        <div id="modalclose"><button class="close">X</button></div>
        <div id="playerData"></div>
    </div>
<!--Confirm Button -->
    <button id="confirmSquad" class="btn disabled">Confirm Squad</button>

    <nav class=" footer navbar navbar-default navbar-fixed-bottom">
        <div class="footer">
            <p>Developed by <b>Delta Force.</b></p>
        </div>
    </nav>
    </body>
</html>
