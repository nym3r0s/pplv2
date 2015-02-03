<?php
session_start();
$user = $_SESSION['admin'];
if(!isset($user))
{
    header('Location: ./login.php');
}
?>
<html>
  <head>
    <link rel="stylesheet" href="./../includes/bootstrap/dist/css/bootstrap-cyborg.min.css">
    <link rel="stylesheet" href="./../includes/css/style.css">
    <script src="./../includes/jquery-2.1.1.min.js"></script>
  </head>
  <body>

<!--      Nav starts Here-->

    <div class="container">

      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="collapse navbar-collapse">
            <div class="navbar-header">
                <a href="/ppl/home/home.php">
                    <div class="navbar-brand">
                       PPL-2015
                    </div>
                </a>
            </div>
             <ul class="nav navbar-nav">
              <li class="col-md-2 active">
                 <a href="./addScores.php">Scoring</a>
              </li>
              <li class="col-md-2">
                 <a href="./addRound.php">AddRound</a>
              </li>
            </ul>
            <div class="navbar-header navbar-right">
                <a href="./logout.php">
                    <div class="navbar-brand navbar-right">
                        Logout <?php echo($user); ?>
                    </div>
                </a>
            </div>
          </div>
        </div>
      </nav>
    </div>
<!-- Nav  Ends here-->

  </body>
</html>
