<?php session_start(); 
require "./config/db.php";
require "./includes/header.php";



?>

<?php


if(isset($_POST['submit'])) {
    require "./config/db.php";

    if(isset($_FILES["file"])) {
        $file = $_FILES["file"];
        //print_r($file);
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileTmpName = $file['tmp_name'];
        $fileError= $file['error'];
      
        print_r($fileTmpName);
      

        $fileDestination = 'uploads/'.$fileName;

      

        move_uploaded_file($fileTmpName, $fileDestination);

        

        $body = $_POST['body'];
        $author = $_POST['author'];
        $inputId = $_POST['inputId'];
        






        if(isset($_FILES["videoFile"])) {
            $files = $_FILES["videoFile"];
            $fileNames = $files['name'];
            $fileErrors = $files['error'];
            $fileTypes = $files['type'];
            $fileTmpNames = $files['tmp_name'];
          
            $fileSizes = $files['size'];
                
            
            $fileDestinations = 'uploadVideos/'.$fileNames;
                move_uploaded_file($fileTmpNames, $fileDestinations);
    
            
        }   
    

      
    }

    $stmt = $pdo->prepare("INSERT INTO posts (author, body, inputId, image, video ) Values(?, ?, ?, ?, ?)");
    $stmt->execute([ $author, $body, $inputId, $fileName, $fileNames ]);
    




}



if(isset($_SESSION['userId'])) {
    require "./config/db.php";
    require "./addpostform.php";
    
    
}else{
    
    echo 'session not started here';
}


?>



<?php require "./includes/footer.php";?>