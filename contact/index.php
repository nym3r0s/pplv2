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
    <title>PPL'15</title>
    <script src="./../includes/jquery-2.1.1.min.js"></script>
    <link rel="stylesheet" href="./../includes/css/bootstrap.css">
    <script src="../includes/bootstrap.js"></script>

    <link rel="stylesheet" href="./../includes/css/common.css">
    <style>
        h4,h1{
            font-family:"Roboto";
        }
    </style>
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
                    <li class="drop" role="presentation"><a role="menuitem" tabindex="-1" href="./">Contact</a></li>
                    <li class="drop" role="presentation" class="divider"></li>
                    <li class="drop" role="presentation"><a role="menuitem" tabindex="-1" href="./../logout.php">Logout</a></li>
                </ul>
                </div>
            </div>
      </div>
      </div>
    </nav>
    <div style="position:absolute; width:100%; height:10px; top:20%;">
    <h1><center>Contact</center></h1>
        <div style="float:left;width:20%;margin:5% 0% 0% 20%;"><center><h4>Ajay Prasadh</h4><h5> +91-85084-07917</h5></center></div>
        <div style="float:left;width:20%;margin:5% 0% 0% 0%;"><center><h4>Karthikeyan</h4><h5> +91-94871-81761</h5></center></div>
        <div style="float:left;width:20%;margin:5% 0% 0% 0%;;"><center><h4>Harsha Manne</h4><h5> +91-87543-35248</h5></center></div>
    </div>



    <nav class=" footer navbar navbar-default navbar-fixed-bottom">
        <div class="footer">
            <p>Developed by <b>Delta Force.</b></p>
        </div>
    </nav>

  </body>
</html>
