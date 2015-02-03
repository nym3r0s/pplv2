<?php
session_start();
session_destroy();
?>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <form action="./adminauth.php" method="post" id="theform">
        User:
        <input type="text" name="user" length="20">
        <br>
        <br>
        Pass:
        <input type="password" name="pass">
        <br>
        <br>
        <button onclick="document.getElementById('theform').submit();">Submit</button>
    </form>
</body>

</html>
