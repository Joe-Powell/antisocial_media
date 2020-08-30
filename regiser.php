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




        $stmt = $pdo -> prepare("SELECT * FROM users WHERE username = ? ");
        $stmt -> execute([$username]);
        $profileimg = $stmt->fetch();
        $userid = $profileimg->id;

        $stmt = $pdo -> prepare("INSERT INTO profileimg(userid, status)       #so when you first sign up it pushes the id into profileimg's userid column
            VALUES(?, ?)");
          $stmt -> execute([$userid, 0]);
 
 


    }

 }

}


       
       
   


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
 
</head>
<body>

<h3 class="login-status">Please log in or sign up &#x1F642;</h3>





<div class=formContainer>
  <form class="form-signup" action="register.php" method="post"><br>

        <input required type="text" name="username" placeholder="username"><br>

        <input required type="text" name="email" placeholder="E-mail"><br>

        <input required type="password" name="pwd" placeholder="Password"><br>

        <input required type="password" name="pwd-repeat" placeholder="Confirm Password"><br>

        <button class='submitRegistration' required type="submit" name="signup-submit">Submit</button>

          <?php if(isset($message)){  ?> 
          <h3><?php echo $message ?></h3>
          <?php } ?>    

          <?php if(isset($successMessage)){  ?> 
          <h3><?php echo $successMessage ?></h3>
          <?php } ?>    
  </form>
</div>
       




<?php require "./includes/footer.php";?>
