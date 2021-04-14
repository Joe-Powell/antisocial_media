<!-- this page sends to posts.php -->



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <?php //include "./includes/navbar.php";    
  ?>


  <h3 class="login-status">You can register your new account here or back to <a class="signup" href="index.php">Home</a></h3>

  <div class=formContainer>
    <form class="form-signup" id='form-Signup' action="posts.php" method="post"><br>


      <input id='username' type="text" name="username" placeholder='username'><br>

      <input id='email' type="text" name="email" placeholder="E-mail"><br>


      <label for="location">Name</label>
      <input type="text" name="name" id="name" placeholder="First/Last">

      <label for="location">Location</label>
      <input type="text" name="location" id="location" placeholder='Optional'>

      <label for="profession">Profession</label>
      <input type="text" name="profession" id="profession" placeholder='Optional'>

      <label for="about">About me</label>
      <input type="text" name="about" id="about" placeholder='Optional'>


      <label for="pwd">password</label>

      <input id='pwd' type="password" name="pwd" placeholder="Password"><br>

      <input id='pwdRepeat' type="password" name="pwd-repeat" placeholder="Confirm Password"><br>

      <button class='submitRegistration' id='submitRegistration' type="submit" name="signup-submit">Submit</button>
      <div style="color:orange;" id='errorLanding'></div>

      <?php if (isset($message)) {  ?>
        <h3><?php echo $message ?></h3>
      <?php } ?>

      <?php if (isset($successMessage)) {  ?>
        <h3><?php echo $successMessage ?></h3>
      <?php } ?>
    </form>
  </div>





  <?php require "./includes/footer.php"; ?>