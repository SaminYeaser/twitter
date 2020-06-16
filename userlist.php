<?php
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
function find_user_list($db){
    $result = $db->users->find();
    $users = iterator_to_array($result);
    return $users;
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
<?php require_once 'header.php'?>
<div>
    <p><b>List of users:</b></p>
    <?php
        $userList = find_user_list($db);
        foreach ($userList as $user){
            echo '<span><b><pre>'.$user['username'].'</pre></b></span>';
            echo '<pre><a href="profile.php?id='.$user['_id'].'   ">Visit Profile</a></pre>';
            echo '<pre><a href="follow.php?id='.$user['_id'].'   ">Follow</a></pre>';
            echo '<hr>';
        }
    ?>
</div>
</body>
</html>
