
<?php 
   // echo '<link rel="stylesheet" href="../style.css">'
?>
<div class="containAll">

<nav class="navbar">

<?php  if(isset($_SESSION['userId'])) {
         $sessionid =  $_SESSION['userId'];
         //   echo "Your session ID =  $sessionid";
           $stmt = $pdo -> prepare("SELECT * FROM profileimg WHERE userid = ? ");
           $stmt -> execute([$sessionid]);
           $profimg = $stmt->fetch();
          
         
           if($profimg) {
            
             if($profimg->status == 0) {
                 echo "<img class='imgProf' id='imgProf' 
                  src='uploads/profileDefault.png'  height='60' width='60' ".mt_rand().">   ";
                }
         
             if($profimg->status == 1){
                 echo "<img class='imgProf' id='imgProf'  src='uploads/profile".$profimg->userid.".".$profimg->ext." ' height='60' width='60' ".mt_rand()."> ";   
                }
         
           }
           
          else{
             echo "<img class='imgProf' id='imgProf'  src='uploads/profileDefault.png'  height='60' width='60'  ".mt_rand().">   ";
            }
     
        }     




        ?>
            
    
        <form class='profileUploadForm' id='profileUploadForm' method='post' action='index.php' enctype='multipart/form-data'  >
            <input type='file' name='profileUpload' id='profileUpload' hidden='hidden' >
            <label for='profileUpload' class='profileUploadLabel' id='profileUploadLabel' hidden='hidden'  >Select Profile Picture</label><br>
            <input type='submit' name='submit_new_pro_pic' id='submit_new_pro_pic' value='Insert uploaded picture'   >
        </form>
    
     

<ul>  
   
        <a href="index.php"><li>Home</li>
        <i class="fas fa-home"></i></a>
        <a href="posts.php"><li>Feed</li>
        <i class="fas fa-user-friends"></i></a>
        <a href="post.php"><li>Post</li>
        <i class="fas fa-download"></i></a>

    <?php  if(isset($_SESSION['userId'])){ ?>
        
        <li><form class="logout" action="includes/logout.php" method="post">
        <button type="submit" name="logout-submit">Logout</button>
            </form><i class="fab fa-expeditedssl"></i></li>

    <?php } ?>        

    </ul>
</nav>
