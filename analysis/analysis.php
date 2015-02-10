<?php
session_start();
require './../includes/dbconfig.php';
$user = mysql_real_escape_string($_SESSION['user']);
if(!isset($user))
{
    header('Location: ./../login.php');
}
$round1avg = 0;
$round2avg = 0;
$round3avg = 0;
$round4avg = 0;
$round5avg = 0;
$round6avg = 0;
$round7avg = 0;
$round8avg = 0;

$userQuery = "SELECT * FROM userData WHERE 1";
$userResult = mysql_query($userQuery);

$rows = mysql_num_rows($userResult);

for($i = 0;$i < $rows ;$i++){
$user1 = mysql_result($userResult,$i,"userId1");
$user2 = mysql_result($userResult,$i,"userId2");

	$round1avg  = $round1avg + mysql_result($userResult,$i,"round1Score")/$rows;
	$round2avg  = $round2avg + mysql_result($userResult,$i,"round2Score")/$rows;
	$round3avg  = $round3avg + mysql_result($userResult,$i,"round3Score")/$rows;
	$round4avg  = $round4avg + mysql_result($userResult,$i,"round4Score")/$rows;
	$round5avg  = $round5avg + mysql_result($userResult,$i,"round5Score")/$rows;
	$round6avg  = $round6avg + mysql_result($userResult,$i,"round6Score")/$rows;
	$round7avg  = $round7avg + mysql_result($userResult,$i,"round7Score")/$rows;
	$round8avg  = $round8avg + mysql_result($userResult,$i,"round8Score")/$rows;

if($user == $user1 || $user == $user2){
	$round1 = mysql_result($userResult,$i,"round1Score");
	$round2 = mysql_result($userResult,$i,"round2Score");
	$round3 = mysql_result($userResult,$i,"round3Score");
	$round4 = mysql_result($userResult,$i,"round4Score");
	$round5 = mysql_result($userResult,$i,"round5Score");
	$round6 = mysql_result($userResult,$i,"round6Score");
	$round7 = mysql_result($userResult,$i,"round7Score");
	$round8 = mysql_result($userResult,$i,"round8Score");
}
}
$teamId = "SELECT teamId FROM userData WHERE userId1 = $user or userId2 = $user";
$teamIdQuery = mysql_query($teamId);

$team = mysql_result($teamIdQuery,0,"teamId");

$player = "SELECT playerId FROM confirmedP11 WHERE teamId = '".$team."' ";
$playerQuery = mysql_query($player);

for($i = 0; $i < 11; $i++){
	$playerId[$i] = mysql_result($playerQuery,$i,"playerId");
	$playername = "SELECT * FROM players WHERE playerId = '".$playerId[$i]."' ";
	$playerquery = mysql_query($playername);
	
	$playerName1[$i] = mysql_result($playerquery,0,"name");
	$playerName2 = explode(" ",$playerName1[$i]);
	$pos = substr_count($playerName1[$i]," ");
	
	$playerName[$i] = $playerName2[$pos];
	$playerScore[$i] = mysql_result($playerquery,0,"roundOne");
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PPL'15</title>
		
        <script src='Chart.min.js'></script>
		<script src="./../includes/jquery-2.1.1.min.js"></script>
	
		<!-- Bootstrap core CSS -->
		<link href="../includes/css/bootstrap.css" rel="stylesheet">
		<link href="../includes/css/common.css" rel="stylesheet">
		<link href="analysis.css" rel="stylesheet">
		<script src="../includes/bootstrap.js"></script>
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
					<li class="drop" role="presentation"><a role="menuitem" tabindex="-1" href="#">Contact</a></li>
					<li class="drop" role="presentation" class="divider"></li>
					<li class="drop" role="presentation"><a role="menuitem" tabindex="-1" href="./../logout.php">Logout</a></li>
				</ul>
				</div>
            </div>
      </div>
      </div>
    </nav>
	
	<div class="statBoard">
		<div class="stat">
		<h4><b>100<b></h4>
		<p>Online players</p>
		</div>
		<div class="stat"></div>
		<div class="stat"></div>
		<div class="stat"></div>
	</div>
        <div id="canvasContainer">
		<!-- line chart canvas element -->
		<p style = "margin:0 0 0 7%;padding:0px;float:left"><u>Relative Performance</u></p>
		<p style = "margin:0 0 0 54%;padding:0px;"><u>Team Performance</u></p>
		<canvas id="playerPerformance" class="lineGraph"></canvas>
		<!-- bar chart canvas element -->
        <canvas id="teamPerformance" class="lineGraph"></canvas>
        
		<p style="position:relative;margin:23% 0% 1% 7%;padding:0px;"><u>Pie charts</u></p>
		<canvas id="pie"></canvas>
		</div>
		
	<script>
		var round1 = <?php echo $round1 ; ?> ;
		var round2 = <?php echo $round2 ; ?> ;
		var round3 = <?php echo $round3 ; ?> ;
		var round4 = <?php echo $round4 ; ?> ;
		var round5 = <?php echo $round5 ; ?> ;
		var round6 = <?php echo $round6 ; ?> ;
		var round7 = <?php echo $round7 ; ?> ;
		var round8 = <?php echo $round8 ; ?> ;
		
		var round1avg = <?php echo $round1avg ; ?> ;
		var round2avg = <?php echo $round2avg ; ?> ;
		var round3avg = <?php echo $round3avg ; ?> ;
		var round4avg = <?php echo $round4avg ; ?> ;
		var round5avg = <?php echo $round5avg ; ?> ;
		var round6avg = <?php echo $round6avg ; ?> ;
		var round7avg = <?php echo $round7avg ; ?> ;
		var round8avg = <?php echo $round8avg ; ?> ;
		
		var player0 = "<?php echo $playerName[0] ; ?>" ;
		var player1 = "<?php echo $playerName[1] ; ?>" ;
		var player2 = "<?php echo $playerName[2] ; ?>" ;
		var player3 = "<?php echo $playerName[3] ; ?>" ;
		var player4 = "<?php echo $playerName[4] ; ?>" ;
		var player5 = "<?php echo $playerName[5] ; ?>" ;
		var player6 = "<?php echo $playerName[6] ; ?>" ;
		var player7 = "<?php echo $playerName[7] ; ?>" ;
		var player8 = "<?php echo $playerName[8] ; ?>" ;
		var player9 = "<?php echo $playerName[9] ; ?>" ;
		var player10 = "<?php echo $playerName[10] ; ?>" ;

		var playerscore0 = "<?php echo $playerScore[0] ; ?>" ;
		var playerscore1 = "<?php echo $playerScore[1] ; ?>" ;
		var playerscore2 = "<?php echo $playerScore[2] ; ?>" ;
		var playerscore3 = "<?php echo $playerScore[3] ; ?>" ;
		var playerscore4 = "<?php echo $playerScore[4] ; ?>" ;
		var playerscore5 = "<?php echo $playerScore[5] ; ?>" ;
		var playerscore6 = "<?php echo $playerScore[6] ; ?>" ;
		var playerscore7 = "<?php echo $playerScore[7] ; ?>" ;
		var playerscore8 = "<?php echo $playerScore[8] ; ?>" ;
		var playerscore9 = "<?php echo $playerScore[9] ; ?>" ;
		var playerscore10 = "<?php echo $playerScore[10] ; ?>" ;
			
			var w = window.innerWidth;
			var h = window.innerHeight;
			
			// line chart data
            var playerData = {
                labels : ["Match 1","Match 2","Match 3","Match 4","Match 5","Match 6","Match 7","Match 8"],
                datasets : [
                {
                    fillColor : "#c8c8c8",
                    strokeColor : "#099",
                    pointColor : "#099",
                    pointStrokeColor : "#9DB86D",
                    data : [round1,round2,round3,round4,round5,round6,round7,round8]
                },
                {
                    fillColor : "#a0a0a0",
                    strokeColor : "#a0a0a0",
                    pointColor : "#404040",
                    pointStrokeColor : "#9DB86D",
                    data : [round1avg,round2avg,round3avg,round4avg,round5avg,round6avg,round7avg,round8avg]
                }
			]
            }
            // get line chart canvas
            var playerPerformance = document.getElementById('playerPerformance').getContext('2d');
            
			var canvas = document.getElementsByTagName('canvas')[0];
			canvas.width  = 0.45*w;
			canvas.height = 0.45*h;
			
			
			// draw line chart
            new Chart(playerPerformance).Line(playerData);
           
		   // bar chart data
            var barData = {
                labels : [player0,player1,player2,player3,player4,player5,player6,player7,player8,player9,player10],
                datasets : [
                    {
                        fillColor : "#48A497",
                        strokeColor : "#48A4D1",
                        data : [playerscore0,playerscore1,playerscore2,playerscore3,playerscore4,playerscore5,playerscore6,playerscore7,playerscore8,playerscore9,playerscore10]
                    }
                ]
            }
            // get bar chart canvas
            var teamPerformance = document.getElementById("teamPerformance").getContext("2d");
            canvas = document.getElementsByTagName('canvas')[1];
			canvas.width  = 0.45*w;
			canvas.height = 0.45*h;
			// draw bar chart
            new Chart(teamPerformance).Bar(barData);
    
			var data = [
			{
				value: 300,
				color:"#F7464A",
				highlight: "#FF5A5E",
				label: "Red"
			},
			{
				value: 50,
				color: "#46BFBD",
				highlight: "#5AD3D1",
				label: "Green"
			},
			{
				value: 100,
				color: "#FDB45C",
				highlight: "#FFC870",
				label: "Yellow"
			}
			]
			var pie = document.getElementById("pie").getContext("2d");
            canvas = document.getElementsByTagName('canvas')[2];
			canvas.width  = 0.15*w;
			canvas.height = 0.15*h;
			
			var pieOptions = {
                 segmentShowStroke : false,
                 animateScale : true
            }
			new Chart(pie).Doughnut(data,pieOptions);
	</script>
	<nav class=" footer navbar navbar-default navbar-fixed-bottom">
        <div class="footer">
            <p>Developed by <b>Delta Force.</b></p>
        </div>
    </nav>
    </body>
</html>