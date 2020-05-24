<?php 
    echo '<link rel="stylesheet" href="../style.css">'
?>

<div class="containAll">
    <nav class="navbar">
        <ul>
            <a href="index.php"><li>Home</li></a>
            <a href="posts.php"><li>Posts</li></a>
            <a href="post.php"><li>Post</li></a>

           <?php  if(isset($_SESSION['userId'])){ ?>
            <li><form class="logout" action="includes/logout.php" method="post">
            <button type="submit" name="logout-submit">Logout</button>
                </form></li>

        <?php } ?>        
        </ul>
    </nav>
