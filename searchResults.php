<?php session_start();
require "./config/db.php";




if (isset($_POST['submitSearchUsers'])) {

$nameSearched = $_POST['searchInput'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? ");
$stmt->execute([$nameSearched]);
$totalUsers = $stmt->rowCount();
$profile = $stmt->fetch();

if ($totalUsers > 0) {
echo  "there are " . $totalUsers . " results! ";
echo "<a href='posts.php?user=$profile->id '>
<h3>$profile->username</h3>
<h3>$profile->email</h3>
</a>";


}else {
    echo "There are no results matching your search";
}

}

