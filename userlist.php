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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
