<?php
session_start();
require './../includes/dbconfig.php';
$user = $_SESSION['user'];
?>
<html>
  <head>
    <script src="./../includes/jquery-2.1.1.min.js"></script>
    <link rel="stylesheet" href="./../includes/css/bootstrap.css">
    <link rel="stylesheet" href="./../includes/css/common.css">
    <script src="../includes/bootstrap.js"></script>

    <link rel="stylesheet" href="./instructions.css">
  </head>
  <body>
    <nav class="header navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="../home/home.php">PPL '15</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php
            if(isset($user)){?>
            <li><a href="../transfers/transfers.php">Transfers</a></li>
            <li><a href="../matchday/matchday.php">Matchday</a></li>
            <li><a href="../leaderboard/leaderboard.php">Leaderboard</a></li>
            <li><a href="../wclive/wclive.php">WCLive</a></li>
            <li class="active"><a href="../instructions/instructions.php">Instructions</a></li>
            <?php }else{ ?>
            <li><a href="../wclive/wclive.php">WCLive</a></li>
            <li class="active"><a href="../instructions/instructions.php">Instructions</a></li>
            <?php } ?>
            </ul>
            <?php if(isset($user)){ ?>
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
            <?php } ?>
      </div>
      </div>
    </nav>

<div id="instruction-container">
    <div id="instructions">
<!-- The About part of the event.    \-->
    <h3>About</h3>
        <ul>
        <li>
          Pragyan Premier League is a Cricket Management Event, in which participants have to participate in an auction of players, and decide  their  playing strategy in a virtual Cricket tournament where results are based on matches from the day's world cup game. The event is a fantasy cricket league for the ICC WC 2015.
        </li>

        <li>
 Participants need to buy a virtual squad of 16 players from the entire set of available players subject to financial constraints and select the playing 11 subject to balance (Batsmen:Bowler:Allrounders:Wicketkeeper) constraints
        </li>

        <li>
 The players pick their playing 11 based for each game and based on the performance of the players on the game on the world cup ,the players will be awarded points.
        </li>
        </ul>
    <hr>
<!-- Judging Criteria-->
    <h3>Scoring</h3>
        <ul>
            <li>Participant start with zero points</li>
            <li>For every match, all the participant's players are awarded points based on their performances in the world cup.</li>
            <li>The participant total score is the sum of his individual player scores.</li>
            <li>No points awarded for having balance money in the entire process,meaning user is free to spend the money given to him as much as he likes.</li>
        </ul>
    <hr>
<!-- Player Ratios        -->
    <h3>Player Ratios</h3>
        These are the acceptable ratios for your playing 11.<br><br>
        <table class="table table-bordered" id="ratioTable">
            <thead>
                <tr>
                    <th>Batsmen</th>
                    <th>Bowlers</th>
                    <th>Allrounders</th>
                    <th>Wicket Keepers</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr><td>5</td><td>4</td><td>1</td><td>1</td><td>5 : 4 : 1 : 1</td></tr>
                <tr><td>5</td><td>3</td><td>2</td><td>1</td><td>5 : 3 : 2 : 1</td></tr>
                <tr><td>4</td><td>3</td><td>3</td><td>1</td><td>4 : 3 : 3 : 1</td></tr>
            </tbody>
        </table>
    <hr>

<!--    FAQ  -->
    <h3>FAQ (Frequently Asked Questions)</h3>
    <ul>
        <li>
            <b>Can I make changes to my squad after entering the game?</b><br>
            <p>Yes. You can transfer (buy/sell) players after entering the game. You can confirm your squad only after you have 16 players.
            The number of transfers is limited and the prices of the players may vary after each match.<br>
            Please remember that <b style="color:red;"> changing your squad after confirming your playing 11 will result in your playing 11 being deleted</b>.You               will NOT be allowed to select a team until the next match.
            </p>
        </li>
        <li>
            <b>Can I make changes to my playing 11 after entering the game?</b><br>
            <p>Yes, you may select your playing 11 from your squad before every matchday. You CANNOT change your playing 11 once it is confirmed.             Once the playing 11 has been confirmed, you cannot change it until the next match.
            </p>
        </li>
        <li>
            <b>What happens if I do not submit a playing 11 for a particular match?</b><br>
            <p>The playing 11 which you have already selected for the previous match will be used for the simulation.
            If a team (playing 11) has not been selected previously, you will NOT be considered for that match of PPL-15
            </p>
        </li>
        <li>
            <b>Can I revert back to an old team after confirmed transfers?</b><br>
            <p>No, there is no "revert" feature. You may, however, change your team back to the previous one at the cost of your transfers.</p>
        </li>
        <li>
            <b>Is there any restriction on the ratio for your SQUAD?</b><br>
            <p>No. You are free to choose your SQUAD in any way that you want. Only your TEAM (playing 11) is subject to the ratio.</p>
        </li>
        <li>
            <b>How do I use the interface?</b><br>
            <p>
                <b>Transfers</b><br>
                The area on the left side contains all the available players. The area on the right side contains your present 16-member squad.
                Double-Clicking on a player will cause him to be transferred to the other box. This means that when you double click on the                       player on the left side, you will get him in your squad. Similarly, double clicking on a player in your squad will cause him to                   be discarded from your squad, hence essentially going to the other box. Single clicking on a player displays his details and                     statistics.<br>
                <b>Matchday</b><br>
                Similar to transfers, the area on the left contains your squad. You may choose your playing 11 by double clicking.
                Please note that unlike Transfers, navigating away from the page will cause you to lose your chosen playing 11 IF IT IS NOT                       CONFIRMED. Once confirmed, however, you have essentially locked your playing 11 for the particular match.  Single clicking on a                   player displays his details and statistics.
            </p>
        </li>
        <li>
            <b>Are there any bonus points for the highest balance etc. ? </b><br>
            <p>No, there are no bonus points for having the highest balance money or star players. Your score is computed from the performance of                your team (playing 11) in that day's match.  </p>
        </li>
        <li>
            <b>My team (Playing 11) is not getting confirmed?</b><br>
            <p>This means that your playing 11 is not in the right ratio of players accepted. Refer above for the acceptable ratios of players                  for your team. If you are very sure that your ratio is right and if you have not tried to do anything unethical, please contact                  the event managers immediately.</p>
        </li>
        <li>
            <b>When will the matches be simulated?</b><br>
            <p>The matches will be simulated at 23:59 HRS (IST) of every match day and the scoreboard will be updated immediately.</p>
        </li>

    </ul>
    </div>
    </div>

    <nav class=" footer navbar navbar-default navbar-fixed-bottom">
        <div class="footer">
            <p>Developed by <b>Delta Force.</b></p>
        </div>
    </nav>

  </body>
</html>
