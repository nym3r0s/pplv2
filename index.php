<?php

session_start();
require './includes/dbconfig.php';

// var_dump($_POST);
$uname = mysqli_real_escape_string($link,$_POST['user']);
$pass = mysqli_real_escape_string($link,$_POST['pass']);
// var_dump($pass);

$pass = sha1($pass);

$query = "SELECT * from userLogin where userId='$uname' AND password='$pass' ";
$result = mysqli_query($link,$query);
// var_dump($result);
// var_dump($pass);
// die($result);
if(mysqli_num_rows($result)==1)
{
    $_SESSION['user'] = $uname;
    header('Location: ./home/');
}
else
{
    header('Location: ./login.php');
}
