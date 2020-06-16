<?php

session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['user'])){
    header('Location: index.php');
    echo "<h2>Login first</h2>";
}
$userData = $db->users->findOne(array('_id'=>$_SESSION['user']));

function get_recent_tweets($db){
    $tweets = $db->following->find(array('follower'=>$_SESSION['user']));
    $tweets = iterator_to_array($tweets);
    $following_users = array();
    foreach ($tweets as $user){
        $following_users[] = $user['user'];
    }
    $tweets = $db->tweets->find(array('authorID'=>array('$in'=>$following_users)));
    $recent_tweets = iterator_to_array($tweets);
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
    <title>Document</title>
</head>
<body>
    <?php include ('header.php')?>
    <br>
    <form action="create_tweet.php" method="post">
        <fieldset>
            <label for="tweet">What is on your mind?</label><br>
            <textarea name="body" id="" cols="50" rows="4"></textarea><br>
            <input type="submit" value="Tweet" />
        </fieldset>
    </form>

    <div>
        <p>Tweet form the people you are following</p>
        <?php
        $recent_tweets = get_recent_tweets($db);
        foreach ($recent_tweets as $r_tweets){
            echo '<p><a href="profile.php?id='. $r_tweets['authorID'].'">'.$r_tweets['authorName'].'</a></p>';
            echo '<p>'.$r_tweets['body'].'</p>';
            echo '<p>'.$r_tweets['created'].'</p>';
        }
        ?>
    </div>
</body>
</html>
