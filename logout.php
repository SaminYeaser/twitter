<?php
session_start();

if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
unset($_SESSION['user']);

header('Location: index.php');
exit;
?>