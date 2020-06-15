<?php
require_once 'dbconnect.php';
session_start();
if(!isset($_POST['body'])){
    exit();
}
$user_id = $_SESSION['user'];
$userData = $db->users->findOne(array('_id'=>$user_id));
$body = $_POST['body'];
$date = date('l jS \of F Y h:i:s A');

$db->tweets->insertOne(array(
    'authorID'=>$user_id,
    'authorName'=>$userData['username'],
    'body'=>$body,
    'created'=>$date

));
header('Location: home.php');
?>