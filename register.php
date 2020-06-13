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