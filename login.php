<?php
session_start();

$msg = "Wylogowano";
if(isset($_POST['send']))
{
    require('setup.php');
    $login = $_POST['login'];
    $pass = $_POST['password'];
    $result = $c->query("select id from user where login='$login' and password='$pass'");
    $row = $result->fetch_assoc();
    $id = $row['id'];
    if($id==1)   
    {
        $_SESSION['user_id']=$id;
        $_SESSION['login']=$login;
        header("location: panel.php");
    }
    else
    {
        echo "Sprawdź swój login i hasło!";
    }
}
else
{
    header("location: index.php");
}

?>