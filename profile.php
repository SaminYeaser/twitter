<?php

session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
if(!isset($_GET['id'])){
    header('Location: index.php');
}

$userData = $db->users->findOne(array('_id'=>$_SESSION['user']));
$profile_id = $_GET['id'];
$profileData = $db->users->findOne(array('_id'=>new MongoDB\BSON\ObjectId("$profile_id")));

function get_recent_tweets($db){
    $id = $_GET['id'];
    $result = $db->tweets->find(array('authorID'=>new MongoDB\BSON\ObjectId("$id")));
    $recent_tweets = iterator_to_array($result);
    return $recent_tweets;
}
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
    <title>Twitter</title>
</head>
<body>
    <?php include 'header.php'?>
    <div>
        <?php

        $recent_tweets = get_recent_tweets($db);
        foreach ($recent_tweets as $tweet){
            echo '<p><a href="profile.php?id=' . $tweet['authorID'] . '">' . $tweet['authorName'] . '</a></p>';
            echo '<p>' . $tweet['body'] . '</p>';
            echo '<p>' . $tweet['created'] . '</p>';
            echo '<hr>';
        }

        ?>
    </div>
</body>
</html>