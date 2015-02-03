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
    <script src="./addRoundScript.js"></script>
    <style type="text/css">
        #roundNumDiv{
            position:absolute;
            left:40%;
            right:40%;
            top:30%;
        }
        #createButton{
            position:absolute;
            left:40%;
            right:40%;
            top:40%;
            width:20%;
        }
    </style>
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
              <li class="col-md-2">
                 <a href="./addScores.php">Scoring</a>
              </li>
              <li class="col-md-2 active">
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
    <div class="input-group" style="width:20%;" id='roundNumDiv'>
        <span class="input-group-addon">Round Number</span>
        <input maxlength="1" id="roundNum" class="form-control">
    </div>
        <button class="btn btn-danger" id="createButton"><b>Create</b></button>


  </body>
</html>
