<?php session_start();
require "./config/db.php";
require "./includes/header.php";



?>



<?php

//////////////////////////////////DELETE
if (isset($_POST['delete'])) {
    require "./config/db.php";
    $the_id = $_POST['the_id'];
    $stmt = $pdo->prepare("DELETE FROM posts Where id = ? ");
    $stmt->execute([$the_id]);

    // by putting the delete above the stmt execute I am able to get the delete the first time otherwise have to refresh twice for results
    // or even have this code below it for the first refresh to work or submission.. not sureif this is only with PDO or not...
    // $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC ");
    //$stmt->execute();
    //$posts = $stmt->fetchAll();

}

//--------------EDIT BIO FROM POSTS PAGE ==================================================================================>>>>>>>>>>>>>>>>>>>>>>>>>

if (isset($_POST['editBioSubmission'])) {
    require "./config/db.php";
    $editLocation = $_POST['editLocation'];
    $editProfession = $_POST['editProfession'];
    $editAbout = $_POST['editAbout'];
    $the_id = $_POST['the_id'];
    $stmt = $pdo->prepare("UPDATE profileimg SET location='$editLocation', profession = '$editProfession', about= '$editAbout' WHERE userid = ? ");
    $stmt->execute([$the_id]);
}

//=======================================================================================================================>>>>>>>>>>>>>>>>>>>>>>>>>>>>>



//============Edit Post ======================================================// 

if (isset($_POST['submitEditPost'])) {
    require "./config/db.php";
    $body = $_POST['the_body'];
    $the_id = $_POST['the_id'];
    $stmt = $pdo->prepare("UPDATE posts SET body='$body' WHERE id = ? ");
    $stmt->execute([$the_id]);
}
// =============================================================================//


if (isset($_SESSION['userId'])) {
    require "./config/db.php";
    $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC ");
    $stmt->execute();
    $posts = $stmt->fetchAll();


    $stmt = $pdo->prepare("SELECT * FROM profileimg WHERE userid = ? ");
    $stmt->execute([$_SESSION['userId']]);
    $profimg = $stmt->fetch();

    // profile Bio
    echo "<div class='UserCrudentials' id='UserCrudentials'>
    <h3>Biography</h3><H6 class='editBioBtn' >edit</h6> <br>
    <p><b>Name</b> $profimg->name</p>
    <p><b>From</b>$profimg->location</p>
    <p><b>Profession</b> $profimg->profession</p>
    <p><b>About</b> $profimg->about</p>
    </div>";



    // edit Biography form and container
    echo   "<div class='editBiographyContain'>
    <form class='editBioForm' action='posts.php' method='POST'>
        <ion-icon name='close'></ion-icon>
        <input type='hidden' name='the_id' value='$profimg->userid' >
        <label for='editLocation'>Location</label> 
        <input type='text' name='editLocation' id='editLocation'  value='$profimg->location' >
        <label for='editProfession'>Profession</label> 
        <input type='text' name='editProfession' id='editProfession'  value='$profimg->profession' >
        <label for='editAbout'>About me</label> 
        <textarea type='text' name='editAbout' id='editAbout'  value='what value' >$profimg->about</textarea><br>
        <button class='submitRegistration'  type='submit' name='editBioSubmission'>Submit Changes</button>
    </form>
    </div>";
} else {
    header('Location: index.php');
}

?>



<?php




?>




<div class="postsContainer">


    <?php foreach ($posts as $post) { ?>

        <div class='containerDivs'>




            <!-- This will give the Profile picture for every post -->
            <img class='imgProf' src='<?php
                                        $stmt = $pdo->prepare("SELECT * FROM profileimg WHERE userid = ? ");
                                        $stmt->execute([$post->inputId]);
                                        $profimg = $stmt->fetch();
                                        if ($profimg) {

                                            if ($profimg->status == 0) {
                                                echo 'uploads/profileDefault.png';
                                            } else if ($profimg->status == 1) {
                                                //"<img src='uploads/profile".$profimg->userid.".".$profimg->ext." ' height='50' width='50'>";
                                                echo 'uploads/profile' . $profimg->userid . '.' . $profimg->ext;
                                            }
                                        } else {
                                            echo 'uploads/profileDefault.png';
                                        }





                                        ?>' height='60' width='60'>


            <?php    //////anchor tag takes you to profile of user
            // $stmt = $pdo -> prepare("SELECT * FROM profileimg WHERE userid = ? ");
            // $stmt -> execute([$post->inputId]);
            // $profimg = $stmt->fetch();
            echo "<form method='post' action='index.php?user=" . $profimg->userid . "' >
                <input type='submit' value='see profile'>
                </form>
        
        ";
            ?>


            <h3><?php echo $post->author ?></h3>

            <?php if ($_SESSION['userId'] == $post->inputId) { ?>
                <div class="btnsWrapper">
                    <button class='editBtn'>Edit</button>
                </div>

            <?php }  ?>








            <?php
            if ($post->video  && $post->image) {
                echo   "<P>$post->body</p>
      <img class='postImg' src='uploads/" . $post->image . "' >
      <video width='300' height='210' controls='controls'>
      <source src='uploadVideos/" . $post->video . "' type='video/mp4'>
      </video>
      ";
            } elseif ($post->video) {
                echo   "<P>$post->body</p>
        <video width='300' height='210' controls='controls'>
        <source src='uploadVideos/" . $post->video . "' type='video/mp4'>
        </video>";
            } elseif ($post->image) {
                echo   "<P>$post->body</p>
      <img class='postImg' src='uploads/" . $post->image . "'>
      
      ";
            } else {
                echo   "<P>$post->body</p>";
            }





            ?>





            <?php if ($_SESSION['userId'] == $post->inputId) { ?>

                <div class="editAbsoluteDiv">
                    <form class='formToEdit' action="posts.php" method="POST">
                        <ion-icon name="close-outline"></ion-icon>
                        <textarea name='the_body' type="text" value="<?php echo $post->body  ?>"><?php echo $post->body  ?></textarea>
                        <!-- <input type='text' value="<?php // echo $post->image 
                                                        ?>" > -->
                        <input name='the_id' type="hidden" value="<?php echo $post->id  ?>">
                        <input name='submitEditPost' type="submit" value="Save Changes">
                        <button name='delete' type='submit' class='deleteBtn'>Delete</button>
                    </form>
                </div>




            <?php } ?>

        </div>

    <?php }  ?>



</div>


<?php require "./includes/footer.php"; ?>