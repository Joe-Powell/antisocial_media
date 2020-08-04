<?php session_start();
        require "./config/db.php";


        ///// upload new profile picture

        if(isset($_POST['submit_new_pro_pic'])){
            require "./config/db.php";

            $sessionid =  $_SESSION['userId'];

            $file = $_FILES['profileUpload'];
          
            //print_r($file);
            $fileName = $file['name'];
            $fileType = $file['type'];
            $fileTmpName = $file['tmp_name'];
            $fileError= $file['error'];
            $fileSize = $file['size'];
            $fileExt = explode('.', $fileName);
        
         
            $fileActualExt = strtolower(end($fileExt));
            //print_r($fileName);
        
            $allowed = array('jpg', 'jpeg', 'png', 'pdf');
         
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError ===0) {
                    if ($fileSize < 8000000) {
                        $fileNameNew = "profile".$sessionid.".". $fileActualExt;
                        $fileDestination = 'uploads/'.$fileNameNew;
        
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $stmt = $pdo -> prepare("UPDATE profileimg SET status=1 WHERE userid = ?");
                        $stmt -> execute([$sessionid]);
                        $stmt = $pdo -> prepare("UPDATE profileimg SET ext = ? WHERE userid = ?");
                        $stmt -> execute([$fileActualExt, $sessionid]);

                       

        
                    }else {
                        echo 'your file is too big';
                    }
                } else{
                    echo 'There was an error uploading';
                }
            }else {
                echo 'You cannot upload files of this type';
            }
            
        }





  if(isset($_POST['login-submit'])) {
       require "./config/db.php";
        $unameEmail = $_POST['unameEmail'];
        $password = $_POST['pwd'];

        $stmt = $pdo -> prepare("SELECT * FROM users WHERE username=? OR email=?; "); 
        $stmt -> execute([$unameEmail, $unameEmail]);
        $user = $stmt->fetch();
        
        
        if(isset($user)) {
   if($password == $user->password) {

       //echo 'the login is correct!';
       
    $_SESSION['userId'] = $user->id;
    $_SESSION['username'] = $user->username;
       header('Location:index.php');
       
   } else{
       echo 'the login is not correct';
      $loginWrong = 'the login is not correct';
      echo ' ' .  $user->username . ' ' . $user->password;

   }


}

    }     
    
    
    
    require "./includes/header.php";
   

    
    ?>






<?php  

if(isset($_SESSION['userId'] )) {
    
    if(isset($_GET['user'])) {
        if($_SESSION['userId'] == $_GET['user']) {
         $getUsersId = $_GET['user'];
         $stmt = $pdo->prepare("SELECT * FROM posts WHERE inputid = ? ");
         $stmt->execute([$getUsersId]);
         $posts = $stmt->fetchAll();
            
        echo "<div class='postsContainer'>";


 foreach($posts as $post) { 

    echo "<div class='containerDivs'>";
    
    $stmt = $pdo -> prepare("SELECT * FROM profileimg WHERE userid = ? ");
    $stmt -> execute([$post->inputId]);
    $profimg = $stmt->fetch();

    

  
        
     if($profimg) {
   
        if($profimg->status == 0) {
            echo "<img class='imgProf' src='uploads/profileDefault.png' height='50' width='50'>" ;
        }
    
        else if($profimg->status == 1){
            //"<img src='uploads/profile".$profimg->userid.".".$profimg->ext." ' height='50' width='50'>";
            echo "<img class='imgProf' src='uploads/profile".$profimg->userid.'.'.$profimg->ext."' height='50' width='50'>" ;

        }
    
      }
      
     else{
        echo "<img class='imgProf' src='uploads/profileDefault.png' height='50' width='50'>" ;
    }
    
        echo "<form method='post' action='index.php?user=".$profimg->userid."' >
                <input type='submit' value='see profile'>
                </form>
        
        ";
        


echo "<h3> ".$post->author."</h3>";

 if($_SESSION['userId'] == $post->inputId) { 
        echo "<div class='btnsWrapper'>
            <button  class='editBtn'>Edit</button>
        </div>";

 }  
      







       
    if($post->video  && $post->image ) {
      echo   "<P>$post->body</p>
      <img class='postImg' src='uploads/".$post->image."' >
      <video width='300' height='210' controls='controls'>
      <source src='uploadVideos/".$post->video."' type='video/mp4'>
      </video>
      ";  
    
  }
    elseif($post->video ) {
        echo   "<P>$post->body</p>
        <video width='300' height='210' controls='controls'>
        <source src='uploadVideos/".$post->video."' type='video/mp4'>
        </video>";  
      
    }
    elseif($post->image ) {
      echo   "<P>$post->body</p>
      <img class='postImg' src='uploads/".$post->image."'>
      
      ";  
    
  }else{
    echo   "<P>$post->body</p>";

}
    
  
  
echo "</div>";

}  



echo "</div>";


           
        
 

} elseif($_SESSION['userId'] !== $_GET['user']){
            
    
         $getUsersId = $_GET['user'];
         $stmt = $pdo->prepare("SELECT * FROM posts WHERE inputid = ? ");
         $stmt->execute([$getUsersId]);
         $posts = $stmt->fetchAll();
            

         echo "<div class='postsContainer'>";


 foreach($posts as $post) { 

    echo "<div class='containerDivs'>";
    
    $stmt = $pdo -> prepare("SELECT * FROM profileimg WHERE userid = ? ");
    $stmt -> execute([$post->inputId]);
    $profimg = $stmt->fetch();

    

  
        
     if($profimg) {
   
        if($profimg->status == 0) {
            echo "<img class='imgProf' src='uploads/profileDefault.png' height='50' width='50'>" ;
        }
    
        else if($profimg->status == 1){
            //"<img src='uploads/profile".$profimg->userid.".".$profimg->ext." ' height='50' width='50'>";
            echo "<img class='imgProf' src='uploads/profile".$profimg->userid.'.'.$profimg->ext."' height='50' width='50'>" ;

        }
    
      }
      
     else{
        echo "<img class='imgProf' src='uploads/profileDefault.png' height='50' width='50'>" ;
    }
    
        echo "<form method='post' action='index.php?user=".$profimg->userid."' >
                <input type='submit' value='see profile'>
                </form>
        
        ";
        


echo "<h3> ".$post->author."</h3>";

 if($_SESSION['userId'] == $post->inputId) { 
        echo "<div class='btnsWrapper'>
            <button  class='editBtn'>Edit</button>
        </div>";

 }  
      







       
    if($post->video  && $post->image ) {
      echo   "<P>$post->body</p>
      <img class='postImg' src='uploads/".$post->image."' >
      <video width='300' height='210' controls='controls'>
      <source src='uploadVideos/".$post->video."' type='video/mp4'>
      </video>
      ";  
    
  }
    elseif($post->video ) {
        echo   "<P>$post->body</p>
        <video width='300' height='210' controls='controls'>
        <source src='uploadVideos/".$post->video."' type='video/mp4'>
        </video>";  
      
    }
    elseif($post->image ) {
      echo   "<P>$post->body</p>
      <img class='postImg' src='uploads/".$post->image."'>
      
      ";  
    
  }else{
    echo   "<P>$post->body</p>";

}
    
  
  
echo "</div>";

}  



echo "</div>";

}
   
} 


                    // index.php with no endpoints so just your profile page from navbar selection
else{

 
    $sessionId = $_SESSION['userId'];
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE inputid = ? ");
    $stmt->execute([$sessionId]);
    $posts = $stmt->fetchAll();


    echo "<div class='postsContainer'>";


 foreach($posts as $post) { 

    echo "<div class='containerDivs'>";
    
    $stmt = $pdo -> prepare("SELECT * FROM profileimg WHERE userid = ? ");
    $stmt -> execute([$post->inputId]);
    $profimg = $stmt->fetch();

    

  
        
     if($profimg) {
   
        if($profimg->status == 0) {
            echo "<img class='imgProf'  src='uploads/profileDefault.png' height='50' width='50'>" ;
        }
    
        else if($profimg->status == 1){
            //"<img src='uploads/profile".$profimg->userid.".".$profimg->ext." ' height='50' width='50'>";
            echo "<img class='imgProf'  src='uploads/profile".$profimg->userid.'.'.$profimg->ext."' height='50' width='50'>" ;

        }
    
      }
      
     else{
        echo "<img class='imgProf'  src='uploads/profileDefault.png' height='50' width='50'>" ;
    }
    
        echo "<form method='post' action='index.php?user=".$profimg->userid."' >
                <input type='submit' value='see profile'>
                </form>
        
        ";
        


echo "<h3> ".$post->author."</h3>";

 if($_SESSION['userId'] == $post->inputId) { 
        echo "<div class='btnsWrapper'>
            <button  class='editBtn'>Edit</button>
        </div>";

 }  
      







       
    if($post->video  && $post->image ) {
      echo   "<P>$post->body</p>
      <img class='postImg' src='uploads/".$post->image."' >
      <video width='300' height='210' controls='controls'>
      <source src='uploadVideos/".$post->video."' type='video/mp4'>
      </video>
      ";  
    
  }
    elseif($post->video ) {
        echo   "<P>$post->body</p>
        <video width='300' height='210' controls='controls'>
        <source src='uploadVideos/".$post->video."' type='video/mp4'>
        </video>";  
      
    }
    elseif($post->image ) {
      echo   "<P>$post->body</p>
      <img class='postImg' src='uploads/".$post->image."'>
      
      ";  
    
  }else{
    echo   "<P>$post->body</p>";

}
    
  if($_SESSION['userId'] == $post->inputId) {
        
    echo "<div class='editAbsoluteDiv'>
        <form class='formToEdit' action='posts.php' method='POST'>
            <ion-icon name='close-outline'></ion-icon>
            <textarea name='the_body' type='text' value='". $post->body."' >echo $post->body </textarea>
            
            <input name='the_id' type='hidden' value='".$post->id."'>
            <input name='submit' type='submit' value='Save Changes'>
            <button  name='delete' type='submit' class='deleteBtn'>Delete</button>
        </form>
    </div>";
        
        
        
        
     }     
  
echo "</div>";

}  



echo "</div>";

}
   
 

} 


?>






<?php require "./includes/footer.php";?>
