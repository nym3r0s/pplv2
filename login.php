<?php
session_start();
session_destroy();
?>
<html>

<head>
    <title>PPL '15</title>
	<link href="./includes/css/bootstrap.css" rel="stylesheet">
    <link href="./includes/css/common.css" rel="stylesheet">
	<link href="./includes/css/login.css" rel="stylesheet">
</head>

<body>
	<nav class="header navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="">PPL '15</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../leaderboard/leaderboard.php">Leaderboard</a></li>
			<li><a href="../wclive/wclive.php">WCLive</a></li>
            </ul>
		</div>
      </div>
	</nav>
	
	<form id="loginbox" action="./index.php" method="POST" class="form-horizontal" role="form">
		<legend style="margin-bottom: 25px;">Sign in</legend>
        <div style="margin-bottom: 25px" class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input type="text" name="user" class="form-control input-lg" placeholder="Username">                     
		</div>
                           
        <div style="margin-bottom: 25px" class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			<input type="password" name="pass" class="form-control input-lg" placeholder="Password">
		</div>                                 
                                
        <div class="input-group">
			<div class="checkbox">
            <label>
				<input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
            </label>
            </div>
        </div>
		<div class="form-group" style="margin-top:30px;">
			<button class="btn btn-primary btn-lg btn-block">Sign In</button>
		</div> 
	</form>
	
	<nav class=" footer navbar navbar-default navbar-fixed-bottom">
		<div class="footer">
			<p>Developed by Delta Force</p>
		</div>
	</nav>
</body>
</html>
