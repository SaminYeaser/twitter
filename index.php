<?php
session_start();
require_once('dbconnect.php');

//    if(isset($_SESSION['user'])){
//        header('home.php');
//    }
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = $db->users->findOne(array('username' => $username));
        if($result){
            if (password_verify($password, $result->password)) {
                $_SESSION['user'] = $result->_id;
                header('Location: home.php');
            } else {

            }

        }


    }
//        if(!$result){
//
//        }else{
//





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
    <form method="post" action="index.php">
        <fieldset>
            <label for="username">UserName: </label>
            <input type="text" name="username">
            <label for="password">Password: </label>
            <input type="password" name="password">
            <button type="submit" name="submit">Submit</button>
        </fieldset>
    </form>
    <a href="register.php">No account? Register here</a>
</body>
</html>