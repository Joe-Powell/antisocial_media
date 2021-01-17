<?php session_start();
require "./config/db.php";
require "./includes/header.php";



if (isset($_POST['submitSearchUsers'])) {

    $nameSearched = $_POST['searchInput'];

    $stmt = $pdo->prepare("SELECT * FROM profileimg WHERE name Like ? OR name LIKE ? ");

    $params = array("%$nameSearched%", "%$nameSearched[0]%");

    $stmt->execute($params);
    $totalUsers = $stmt->rowCount();
    $profimg = $stmt->fetchAll();



    if ($totalUsers > 0) {
        echo  "<div class='rowCountUsers'>there are " . $totalUsers . " results!</div> ";

        foreach ($profimg as $pro) {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? ");
            $stmt->execute([$pro->userid]);
            $user = $stmt->fetch();
            echo "<a href='posts.php?user=$user->id' ><div class='searchPageContainer'>";

            require "./profileImageWithoutUpload.php";

            echo "<h3>$pro->name</h3>
         <h3>$user->email</h3>

         </div></a>";
        }
    } else {
        echo "<div class='noResultsMsg'>There are no results matching your search</div";
    }
}


// first in here we are first checking in profileimg table for a name column thats LIKE searchInput .. 
// as long as there are more that 0 results, we will make a foreach loop and for every result of that query we will SELECT 
//from the users table and look for an ID that matches that userid column of the profileimg table    