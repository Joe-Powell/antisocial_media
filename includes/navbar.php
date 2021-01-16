<?php
require "./config/db.php";

?>







<nav class="navbar">

    <?php if (isset($_SESSION['userId'])) {
        $sessionid =  $_SESSION['userId'];
        //   echo "Your session ID =  $sessionid";
        $stmt = $pdo->prepare("SELECT * FROM profileimg WHERE userid = ? ");
        $stmt->execute([$sessionid]);
        $profimg = $stmt->fetch();


        //require "./profileImage.php";
    }




    ?>






    <ul>

        <a href="index.php">
            <li>Home</li>
            <i class="fas fa-home"></i>
        </a>
        <a href="posts.php">
            <li>profile</li>
            <i class="fas fa-user-friends"></i>
        </a>
        <a href="post.php">
            <li>Post</li>
            <i class="fas fa-download"></i>
        </a>

        <?php if (isset($_SESSION['userId'])) { ?>

            <li>
                <form class="logout" action="includes/logout.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                </form><i class="fab fa-expeditedssl"></i>
            </li>

        <?php } ?>

    </ul>
    <div class='searchUserDiv'>
        <form class='searchForm' action='searchResults.php' method='post'>
            <input type='text' name='searchInput' class='searchInput' placeholder='Search Users'>
            <button type='submit' name='submitSearchUsers' hidden='hidden'>Search</button>
        </form>
    </div>
</nav>