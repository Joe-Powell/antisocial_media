<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
 
</head>
<body>
    

<?php
    if(isset($_SESSION['userId'])) {
        include "navbar.php";

    }else{
        echo '<h3 class="login-status">Please log in or sign up &#x1F642;</h3>';

echo ' <div class="contLogSignup"> 
            <form class="form-login" action="index.php" method="post">
                <label for="unameEmail">Username/Email</label> 
                <input required type="text" name="unameEmail" id="unameEmail" >
                <label for="pwd">Password</label> 
                <input required type="password" name="pwd" id="pwd"  >
                <button type="submit" name="login-submit">Login</button>
                <a class="signup" href="register.php">Signup</a>  
            </form>
        
      
    </div>';

}













?>


