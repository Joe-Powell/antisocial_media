<?php session_start();
        require "./config/db.php";


        
///// Register this comes from register.php  the action sends it here......////////////////////////////////////////////////////////////////////
if(isset($_POST['signup-submit'])) {
    require "./config/db.php";
    $username = $_POST['username']; 
    $email = $_POST['email']; 
    $password = $_POST['pwd']; 
    $passwordRepeat = $_POST['pwd-repeat'];
    $location = $_POST['location'];
    $profession = $_POST['profession'];
    $about = $_POST['about'];

    if ($password !== $passwordRepeat) {
      $message = "passwords don't match";

    }else{
       $stmt = $pdo ->prepare( "SELECT username FROM users WHERE username=?");
        $stmt -> execute([$username]);
        $totalUsers = $stmt -> rowCount();
       
       if($totalUsers > 0) {
       
      $emailTaken = 'Email already taken <br>';
    }else {
        $stmt = $pdo -> prepare('INSERT into users (username, email, password) VALUES(?, ?, ?)');
        $stmt -> execute([$username, $email, $password]);




        $stmt = $pdo -> prepare("SELECT * FROM users WHERE username = ? ");
        $stmt -> execute([$username]);
        $profile = $stmt->fetch();

        $userid = $profile->id;
        $usersName = $profile->username;

        $stmt = $pdo -> prepare("INSERT INTO profileimg(userid, status, location, profession, about, name)       #so when you first sign up it pushes the id into profileimg's userid column
            VALUES(?, ?, ?, ?, ?, ?)");
          $stmt -> execute([$userid, 0, $location, $profession, $about, $usersName]);
 
 


    }

 }

}

///////////////////////end registration///////////////////////////////////////////////////////////////////////



       

    ///////////////////////////////////////// upload new profile picture///////////////////////////////////////////////////////////////////////
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


    /////////////////////////End upload new profile picture//////////////////////////////////////////////////////////////////////////////////////////////////////




    //////////////////////////////////////  Login submission   ////////////////////////////////////////////////////////////////////////
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
    

//////////////////////////End Login submission ///////////////////////////////////////////////////////////////////////////////////////////////
    
    require "./includes/header.php";
   

    
    ?>






<?php  

////////////////////////////////////////////// Submission of edit bio editBioSubmission  ///////////////////////////////////////
if(isset($_POST['editBioSubmission'])) {
    require "./config/db.php";
    $editLocation = $_POST['editLocation'];
    $editProfession = $_POST['editProfession'];
    $editAbout = $_POST['editAbout'];
    $the_id = $_POST['the_id'];
    $stmt = $pdo->prepare("UPDATE profileimg SET location='$editLocation', profession = '$editProfession', about= '$editAbout' WHERE userid = ? ");   
    $stmt->execute([$the_id]);




}

/////////////////////////////////////////////////end editBioSubmission    //////////////////////////////////////////////////////////


            ///////////////////////////////////////if is logged in 
if(isset($_SESSION['userId'] )) {

    /////////$_GET START so this is if looking at a Profile/////////////////
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
//// end of for each here,  $posts as $post this is pdo so we use $post->body ..... 



echo "</div>";

}
   
    } //$_GET ends here so this was if looking at a Profile///////////////////////////////////////////////////


                    //////////////// index.php home...
else{

 
    $sessionId = $_SESSION['userId'];
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE inputid = ? ");
    $stmt->execute([$sessionId]);
    $posts = $stmt->fetchAll();

  

    // profile Bio 
    $stmt = $pdo -> prepare("SELECT * FROM profileimg WHERE userid = ? ");
    $stmt -> execute([$_SESSION['userId']]);
    $profimg = $stmt->fetch();
    
    echo "<div class='UserCrudentials' id='UserCrudentials'>
    <h3>Biography</h3><H6 class='editBioBtn' >edit</h6> <br>
    <p><b>Name</b> $profimg->name</p>
     <p><b>From</b>$profimg->location</p>
     <p><b>Profession</b> $profimg->profession</p>
     <p><b>About</b> $profimg->about</p>
     </div>";


     // edit Biography form and container
     echo "<div class='editBiographyContain'>
        

     <form class='editBioForm' action='index.php' method='POST'>

            <input type='hidden' name='the_id' value='$profimg->userid' >
     
             <label for='editLocation'>Location</label> 
             <input type='text' name='editLocation' id='editLocation'  value='$profimg->location' >

             <label for='editProfession'>Profession</label> 
             <input type='text' name='editProfession' id='editProfession'  value='$profimg->profession' >

             <label for='editAbout'>About me</label> 
             <input type='text' name='editAbout' id='editAbout'  value='$profimg->about' ><br>

             <button class='submitRegistration'  type='submit' name='editBioSubmission'>Submit Changes</button>
     </form>

     <ion-icon name='close'></ion-icon>
 


</div>";



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



    /*So this editAbsoluteDiv which exists for every post is set to display='none', 
    which has a form inside it, it holds the hidden ID for that particular post, and body. 
    we loop through them all and make the individual one pop up display ='flex'. 
    it is absolute with a background so you cant click other edit buttons. 
    remember that this hidden input has a name called 'the_id' to grab its value  */
        
    echo "<div class='editAbsoluteDiv'>                                     
        <form class='formToEdit' action='posts.php' method='POST'>
            <ion-icon name='close-outline'></ion-icon>
            <textarea name='the_body' type='text' value='". $post->body."' > $post->body </textarea>
            
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






<?php require "./includes/footer.php";  ?>