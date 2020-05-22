<?php session_start();


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

  echo '<p class ="login-status">You are logged in &#x1F603;	</p>';
  echo "<br> <h3> Welcome " .$_SESSION['username']. ", your user Id # is " .$_SESSION['userId'];

}else{

  echo '<p class="login-status">You are logged out!</p>';

}


?>






<?php require "./includes/footer.php";?>
