<?php

session_start();
require_once 'dbconnect.php';
if(!isset($_SESSION['user'])){
    header('index.php');
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
</body>
</html>
