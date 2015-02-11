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
    <script src="../includes/bootstrap.js"></script>

    <!-- CSS styles  -->
    <link href="./matchdayStyle.css" rel="stylesheet">

    <!-- Adding the Appropriate JS file  -->
    <script src="./ratioCheck.js"></script>
<?php

    if($userP11 == 0)
        echo('<script src="./matchdayNotConfirmed.js"></script>');
    else
    {
        echo('<script src="./matchdayConfirmed.js"></script>');
        echo('<script src="./../includes/imgAnim/matchdayImage.js"></script>');
        echo('<link rel="stylesheet" href="./../includes/imgAnim/imageflow.packed.css" type="text/css" />');
//        echo('<style> body { background-color: black; !important}</style>');
    }
?>
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
            <li class="active"><a href="../matchday/matchday.php">Matchday</a></li>
            <li><a href="../leaderboard/leaderboard.php">Leaderboard</a></li>
            <li><a href="../wclive/wclive.php">WCLive</a></li>
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

<!--      This are The main divs - Either if they are choosing or if they have already chosen -->
<?php

if($userP11 == 0)
{
    echo <<< EOD

<!--      The 2 divs for the players-->
    <div id="ratioCheckDiv">Player Ratio</div>
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
<!--Confirm Button -->
    <button id="confirmSquad" class="btn disabled">Confirm Playing Squad</button>

EOD;

}

else
{
    $anyPlayers = false;
    $confirmedListQuery = "SELECT * FROM confirmedP11 WHERE teamId=$userTeamId";
    $confirmedListResult = mysql_query($confirmedListQuery);
    if(mysql_num_rows($confirmedListResult)!=0)
    {
        $anyPlayers = true;
    }
    if($anyPlayers)
    {

    echo <<< EOT
        <h3 id="theHeading"><center>Your Playing 11</center></h3>
        <div id="animContainer">
        <div id="confirmed11" class="imageflow">
EOT;


    for($i=0;$i<mysql_num_rows($confirmedListResult);$i++)
    {
            $playerId    = mysql_result($confirmedListResult,$i,"playerId");

            $playerQuery = "SELECT * FROM players WHERE playerId=$playerId";
            $playerResult = mysql_query($playerQuery);


            $playerName    = mysql_result($playerResult,0,"name");
            $playerCountry = mysql_result($playerResult,0,"country");
            $playerType    = mysql_result($playerResult,0,"type");
            $playerCaptain = mysql_result($playerResult,0,"captain");
            $photoUrl      = mysql_result($playerResult,0,"photoUrl");
//        echo("<tr><td>$playerName</td><td>$playerCountry</td><td>$playerType</td></tr>");
          echo('<img src="'.$photoUrl.'" width="250" height="250" class="imgAnimPic" alt="'.$playerName."<br>".$playerCountry.'<br>'.$playerType.'">');
    }


    echo <<< EOD

    <!--        </tbody> -->
    <!--        </table> -->
            </div>
        </div>

EOD;

    }
    else
    {
        echo('<h3 id="sorryMsg"><center>Sorry, you have not confirmed your playing 11.</center></h3>');
    }
}


?>

    <!-- Modal here -->
    <div id="playerInfo">
        <div id="modalclose"><button class="close">X</button></div>
        <div id="playerData"></div>
    </div>

    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="footer">
            <p> Developed by <b>Delta Force.</b></p>
        </div>
    </nav>

    </body>
</html>
