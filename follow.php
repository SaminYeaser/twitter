<?php
session_start();
require_once 'dbconnect.php';

if(!isset($_GET['id'])){
    header('index.php');
}
$user_id = $_GET['id'];
$follower_id = $_SESSION['user'];
$db->following->insertOne(array(
    'user'=>new MongoDB\BSON\ObjectId("$user_id"),
    'follower' => new MongoDB\BSON\ObjectId("$follower_id")
));
header('Location: userlist.php');
?>