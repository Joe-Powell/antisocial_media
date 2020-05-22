<?php session_start(); ?>

<?php require "./includes/header.php";?>

<?php


if(isset($_POST['submit'])) {
    require "./config/db.php";

   
    $body = $_POST['body'];
    $author = $_POST['author'];
    $inputId = $_POST['inputId'];

     $stmt = $pdo->prepare("INSERT INTO posts (author, body, inputId ) Values(?, ?, ?)");
     $stmt->execute([ $author, $body, $inputId]);
    



}



if(isset($_SESSION['userId'])) {
    require "./config/db.php";
    require "./addpostform.php";
     echo 'you are logged in';
    
}else{
    //header('Location: http://myblogs.live/loginSocialMediaPosts/index.php');
    
    echo 'session not started here';
}


?>



<?php require "./includes/footer.php";?>
