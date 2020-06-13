<?php
include 'dbconnect.php';
session_start();
require_once('dbconnect.php');

if(isset($_SESSION['user'])){
    header('home.php');
}
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = hash('sam123',$_POST['password']);
    $result = $db->users->findOne(array('username'=>$username, 'passwword'=>$password));
    if(!$result){

    }else{
        $_SESSION['user'] = $result->id;
        header('Location: home.php');
    }
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <from method="post" action="index.php">
        <fieldset>
            <label for="username">UserName: </label>
            <input type="text" name="username">
            <label for="password">Password: </label>
            <input type="password" name="pasword">
            <input type="submit" value="login">
        </fieldset>
    </from>
    <a href="register.php">No account? Register here</a>
</body>
</html>