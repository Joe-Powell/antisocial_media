<?php
 $host = 'localhost';
 $user = 'root';
 $password = '';
 $dbname = 'databaseboth';
 
 $dsn = 'mysql:host=' . $host . '; dbname=' . $dbname;
 
 try {
 $pdo = new PDO($dsn, $user, $password);
 $pdo->setattribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // echo "Connected successfully";
 } catch(PDOException $e){
     echo "Connection failed: " . $e->getMessage();
 }
  
?>