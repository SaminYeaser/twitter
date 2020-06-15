<?php

session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['user'])){
    header('Location: index.php');
    echo "<h2>Login first</h2>";
}
$userData = $db->users->findOne(array('_id'=>$_SESSION['user']));

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
    <?php include ('header.php')?>
    <br>
    <form action="create_tweet.php" method="post">
        <fieldset>
            <label for="tweet">What is on your mind?</label><br>
            <textarea name="body" id="" cols="50" rows="4"></textarea><br>
            <input type="submit" value="Tweet" />
        </fieldset>
    </form>
</body>
</html>
