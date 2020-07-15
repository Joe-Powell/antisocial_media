<?php session_start();





if(isset($_POST['signup-submit'])) {
    require "./config/db.php";
    $username = $_POST['username']; 
    $email = $_POST['email']; 
    $password = $_POST['pwd']; 
    $passwordRepeat = $_POST['pwd-repeat'];

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
        
        
      // this code makes it so that after you reegister, you will be logged in!  
         require "./config/db.php";
        $username = $_POST['username']; 
        $email = $_POST['email']; 
        $password = $_POST['pwd']; 

        $stmt = $pdo -> prepare("SELECT * FROM users WHERE username=? OR email=?; "); 
        $stmt -> execute([$username, $email]);
        $user = $stmt->fetch();
        
        
        if(isset($user)) {
   if($password == $user->password) {

       //echo 'the login is correct!';
       
    $_SESSION['userId'] = $user->id;
    $_SESSION['username'] = $user->username;
      
       
   } else{
       echo 'the login is not correct';
      $loginWrong = 'the login is not correct';
      echo ' ' .  $user->username . ' ' . $user->password;

   }


}


       


    }

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
       //header('Location: http://myblogs.live/loginSocialMediaPosts/');
       
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

if(isset($_SESSION['userId'])) {

  echo ' <p class ="login-status">You are logged in &#x1F603;	</p>';
  echo "<br> <h3 class ='login-status'> Welcome " .$_SESSION['username'] ."!</h3>" ;
}else{

  echo '<h3 class="login-status">Please Log in or sign up &#x1F642;</h3>';

}


?>






<?php require "./includes/footer.php";?>
