<?php

session_start();
require './includes/dbconfig.php';

$uname = mysql_real_escape_string($_POST['user']);
$pass = mysql_real_escape_string($_POST['pass']);

$pass = sha1($pass);

$query = "SELECT * from userLogin where userId='$uname' AND password='$pass' ";
$result = mysql_query($query);

if(mysql_num_rows($result)==1)
{
    $_SESSION['user'] = $uname;
    header('Location: ./home/home.php');
}
else
{
    header('Location: ./login.php');
}
