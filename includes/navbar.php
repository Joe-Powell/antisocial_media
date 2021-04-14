<?php
require "./config/db.php";

?>







<nav class="navbar">

    <?php if (isset($_SESSION['userId'])) {
        $sessionid =  $_SESSION['userId'];
        // echo "Your session ID =  $sessionid";
        $stmt = $pdo->prepare("SELECT * FROM profileimg WHERE userid = ? ");
        $stmt->execute([$sessionid]);
        $profimg = $stmt->fetch();
    }
    ?>

    <ul>

        <a href="index.php">
            <li>Home</li>
        </a>
        <?php if (isset($_SESSION['userId'])) { ?>
            <a href="posts.php">
                <li>profile</li>
            </a>

            <a href="post.php">
                <li>Post</li>

            </a>
        <?php } ?>


        <?php if (isset($_SESSION['userId'])) { ?>

            <li>
                <form class="logout" action="includes/logout.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                </form>
            </li>

        <?php } ?>

        <?php if (!isset($_SESSION['userId'])) { ?>
            <li class='loginBtnNav'>Login</li>

            <a class="signup" href="register.php">
                <li class='createAccountBtnNav'>Create Account</li>
            </a>

        <?php } ?>


        <li>
            <ion-icon class='searchIcon' name="search-outline"></ion-icon>
        </li>

    </ul>

    <div class='searchUserDiv'>
        <form class='searchForm' action='searchResults.php' method='post'>
            <input type='text' name='searchInput' class='searchInput' placeholder='Search Users'>
            <button type='submit' name='submitSearchUsers' hidden='hidden'>Search</button>
        </form>
    </div>


</nav>