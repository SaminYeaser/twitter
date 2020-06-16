<div>
    <span><h1>Welcome to twitter <?php echo $userData['username']?></h1></span><br>
    <a href="home.php">Home</a>
    <a href="profile.php?id=<?php echo $_SESSION['user']?>">View Profile</a>
    <a href="userlist.php">View Users</a>
    <a href="logout.php">Logout</a>
</div>