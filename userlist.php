<?php
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['user'])){
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
<?php require_once 'header.php'?>
<div>
    <p><b>List of users:</b></p>
    <?php
        $userList = find_user_list($db);
        foreach ($userList as $user){
            echo '<span>'.$user['username'].'</span>';
            echo '<a href="profile.php?id='.$user[_id].'">Visit Profile</a>';
            echo '<a href="follow.php?id='.$user[_id].'">Follow</a>';
        }
    ?>
</div>
</body>
</html>
