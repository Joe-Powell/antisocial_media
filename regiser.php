<?php session_start(); ?>

<?php

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
        //header('Location: index.php');


    }

 }

}


       
       
   


?>





<?php require "./includes/header.php";?>

<div class=formContainer>
<form class="form-signup" action="register.php" method="post"><br>

        <input required type="text" name="username" placeholder="username"><br>

        <input required type="text" name="email" placeholder="E-mail"><br>

        <input required type="password" name="pwd" placeholder="Password"><br>

        <input required type="password" name="pwd-repeat" placeholder="Confirm Password"><br>

        <button required type="submit" name="signup-submit">Submit</button>

          <?php if(isset($message)){  ?> 
          <h3><?php echo $message ?></h3>
          <?php } ?>    

          <?php if(isset($successMessage)){  ?> 
          <h3><?php echo $successMessage ?></h3>
          <?php } ?>    
        </form>
</div>
       




<?php require "./includes/footer.php";?>
