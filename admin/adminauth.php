<?php

session_start();
require './../includes/dbconfig.php';

$uname = $_POST['user'];
$pass = $_POST['pass'];

$pass = sha1($pass);

$query = "SELECT * from adminLogin where userId='$uname' AND password='$pass' ";
$result = mysqli_query($link,$query);

if(mysqli_num_rows($result)==1)
{
    $_SESSION['admin'] = $uname;
    header('Location: ./addScores.php');
}
else
{
    header('Location: ./login.php');
}
