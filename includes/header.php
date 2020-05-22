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
        include "navbar.php";
echo ' <form class="form-login" action="index.php" method="post">
            <input required type="text" name="unameEmail" id="" placeholder="Username/E-mail...."><br><br><br>
            <input required type="password" name="pwd" id="password" >
           
            <button type="submit" name="login-submit">Login</button>
        </form>
    <a class="signup" href="register.php">Signup</a>';

}


?>


