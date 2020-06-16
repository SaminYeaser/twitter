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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php include ('header.php')?>
    <br>
    <div class="body">
        <div class="container">
            <div class="row">

                        <div class="form">

                                <div class="col-6">
                                    <form action="create_tweet.php" method="post">
                                        <fieldset>
                                            <label for="tweet">What is on your mind?</label><br>
                                            <textarea name="body" id="" cols="50" rows="4"></textarea><br>
                                            <input type="submit" value="Tweet" />
                                        </fieldset>
                                    </form>
                                </div>

                        </div>

                        <div class="d-flex justify-content-center">

                            <div class="col-6">
                                <h3>Tweet form the people you are following</h3>
                                <?php
                                $recent_tweets = get_recent_tweets($db);
                                foreach ($recent_tweets as $r_tweets){
                                    echo '<p><a href="profile.php?id='. $r_tweets['authorID'].'">'.$r_tweets['authorName'].'</a></p>';
                                    echo '<p>'.$r_tweets['body'].'</p>';
                                    echo '<p>'.$r_tweets['created'].'</p>';
                                }
                                ?>
                            </div>

                    </div>

            </div>
        </div>
    </div>

</body>
</html>
