<?php session_start(); ?>

<?php require "./includes/header.php";?>

<?php


if(isset($_POST['submit'])) {
    require "./config/db.php";

    $file = $_FILES["file"];
    //print_r($file);
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTmpName = $file['tmp_name'];
    $fileError= $file['error'];
    $fileSize = $file['size'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    //print_r($fileTmpName);
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    $explode_filename = explode('.', $fileName);
    $newFileName = $explode_filename[0];

    $fileNameNew = $newFileName . "." . $fileActualExt;   //  the file and extension, I already made image column in database to catch it

    $fileDestination = 'uploads/'.$fileNameNew;

    if (in_array($fileActualExt, $allowed)) {
        if ($fileSize < 1000000) {
            move_uploaded_file($fileTmpName, $fileDestination);

        }



    }

    $body = $_POST['body'];
    $author = $_POST['author'];
    $inputId = $_POST['inputId'];
    $fileNameNew = $newFileName . "." . $fileActualExt;  // just declairing again to show whats happening

     $stmt = $pdo->prepare("INSERT INTO posts (author, body, inputId, image ) Values(?, ?, ?, ?)");
     $stmt->execute([ $author, $body, $inputId, $fileNameNew ]);
    
     //header('Location: posts.php');


}



if(isset($_SESSION['userId'])) {
    require "./config/db.php";
    require "./addpostform.php";
    
    
}else{
    //header('Location: http://myblogs.live/loginSocialMediaPosts/index.php');
    
    echo 'session not started here';
}


?>



<?php require "./includes/footer.php";?>
