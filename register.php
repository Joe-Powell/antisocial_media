<!-- this page sends to index.php  -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
 
</head>
<body>

<h3 class="login-status">you can register your new account here or <a class="signup" href="index.php">Login</a> &#x1F642;</h3>





<div class=formContainer>
  <form class="form-signup" action="index.php" method="post"><br>

        <input required type="text" name="username" placeholder="username"><br>

        <input required type="text" name="email" placeholder="E-mail"><br>


                <label for="location">Location</label> 
                <input type="text" name="location" id="location" placeholder='Optional'>

                <label for="profession">Profession</label> 
                <input type="text" name="profession" id="profession" placeholder='Optional' >

                <label for="about">About me</label> 
                <input type="text" name="about" id="about" placeholder='Optional' >

        
        <label for="pwd">password</label> 

        <input required type="password" name="pwd" placeholder="Password"><br>

        <input required type="password" name="pwd-repeat" placeholder="Confirm Password"><br>

        <button class='submitRegistration'  type="submit" name="signup-submit">Submit</button>

          <?php if(isset($message)){  ?> 
          <h3><?php echo $message ?></h3>
          <?php } ?>    

          <?php if(isset($successMessage)){  ?> 
          <h3><?php echo $successMessage ?></h3>
          <?php } ?>    
  </form>
</div>
       




<?php require "./includes/footer.php";?>
