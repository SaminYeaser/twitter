<?php
session_start();
require_once 'dbconnect.php';
if(!isset($_SESSION['user'])){
    header('index.php');
}
unset($_SESSION['user']);
session_unset();
session_destroy();
header('index.php');
exit();
?>