
<?php 
    echo '<link rel="stylesheet" href="../style.css">'
?>
<div class="containAll">

<nav class="navbar">
    <ul>
        <a href="index.php"><li><ion-icon name="home-outline"></ion-icon> Home</li></a>
        <a href="posts.php"><li> &#x1F4C4; Newsfeed</li></a>
        <a href="post.php"><li> &#x1F4E5; Post</li></a>

    <?php  if(isset($_SESSION['userId'])){ ?>
        
        <li><form class="logout" action="includes/logout.php" method="post">
        <button type="submit" name="logout-submit">&#x274C; Logout</button>
            </form></li>

    <?php } ?>        

    </ul>
</nav>
