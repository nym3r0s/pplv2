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
    <link rel="stylesheet" href="./home.css">
    <script src="./../includes/jquery-2.1.1.min.js"></script>
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

      <?php

        $query = "SELECT * FROM userData WHERE userId1=$user or userId2=$user ;";
        $result = mysql_query($query);

        if(isset($result)&&(mysql_num_rows($result)>0))
        {
            $teamid = mysql_result($result,0,"teamId");
            $score  = mysql_result($result,0,"score");
            $money   = mysql_result($result,0,"actualBalance");
        }
        else
        {
            echo('No such team / player not registered ');
        }
        ?>


    <center>
        <h2>Welcome Back</h2>
<!--        <h3>Team ID: <?php echo($teamid); ?></h3>-->
        <h3>Player ID: <?php echo($user); ?></h3>
<!--        <h3>Money : <?php echo($money); ?></h3>-->
        <h4>Score: <? echo($score); ?></h4>
    </center>
      <hr>

      <h2><center>Fixtures</center></h2>

      <table class="table table-striped" id="fixtures">
          <thead>
              <tr>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Match</th>
                  <th>Venue</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>Feb 14</td>
                  <td>03:30 GMT | 14:30 local 09:00 IST</td>
                  <td>Australia v England</td>
                  <td>Melbourne Cricket Ground</td>
              </tr>
              <tr>
                  <td>Feb 15</td>
                  <td>03:30 GMT | 14:00 local 09:00 IST</td>
                  <td>India v Pakistan</td>
                  <td>Adelaide Oval</td>
              </tr>
              <tr>
                  <td>Feb 16</td>
                  <td>22:00 GMT (prev day) | 11:00 local 03:30 IST</td>
                  <td>Ireland v West Indies</td>
                  <td>Saxton Oval, Nelson</td>
              </tr>
              <tr>
                  <td>Feb 17</td>
                  <td>22:00 GMT (prev day) | 11:00 local 03:30 IST</td>
                  <td>New Zealand v Scotland</td>
                  <td>University Oval, Dunedin</td>
              </tr>
              <tr>
                  <td>Feb 19</td>
                  <td>22:00 GMT (prev day) | 11:00 local 03:30 IST</td>
                  <td>United Arab Emirates v Zimbabwe</td>
                  <td>Saxton Oval, Nelson</td>
              </tr>
              <tr>
                  <td>Feb 20</td>
                  <td>01:00 GMT | 14:00 local 06:30 IST</td>
                  <td>New Zealand v England</td>
                  <td>Westpac Stadium, Wellington</td>
              </tr>
              <tr>
                  <td>Feb 21</td>
                  <td>22:00 GMT (prev day) | 11:00 local 03:30 IST</td>
                  <td>Pakistan v West Indies</td>
                  <td>Hagley Oval, Christchurch</td>
              </tr>
              <tr>
                  <td>Feb 22</td>
                  <td>03:30 GMT | 14:30 local 09:00 IST</td>
                  <td>India v South Africa</td>
                  <td>Melbourne Cricket Ground</td>
              </tr>
          </tbody>
      </table>

      <nav class=" footer navbar navbar-default navbar-fixed-bottom">
        <div class="footer">
            <p>Developed by <b>Delta Force.</b></p>
        </div>
    </nav>

  </body>
</html>
