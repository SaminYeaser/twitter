<?php
session_start();
require_once('dbconnect.php');


//if(isset($_SESSION['user'])){
//    header('Location: home.php');
//}
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $result = $db->users->insertOne(array('username'=>$username, 'password'=>$password));
    header('Location: index.php');
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
<form method="post" action="register.php">
    <fieldset>
        <label for="username">UserName: </label>
        <input type="text" name="username">
        <label for="password">Password: </label>
        <input type="password" name="password">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </fieldset>
</form>
<a href="index.php">Login here</a>
</body>
</html>
