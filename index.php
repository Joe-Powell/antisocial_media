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

//--------------EDIT BIOGraphy ==================================================================================>>>>>>>>>>>>>>>>>>>>>>>>>

if (isset($_POST['editBioSubmission'])) {
    require "./config/db.php";
    $editLocation = $_POST['editLocation'];
    $editProfession = $_POST['editProfession'];
    $editAbout = $_POST['editAbout'];
    $editName = $_POST['editName'];
    $the_id = $_POST['the_id'];
    $stmt = $pdo->prepare("UPDATE profileimg SET location='$editLocation', profession = '$editProfession', about= '$editAbout', name='$editName' WHERE userid = ? ");
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











//=========================Comments  276   ==========================================//

if (isset($_POST['submitComment'])) {
    $commentOnPost = $_POST['commentOnPost'];
    $post_id = $_POST['post_id'];
    $user_id_of_comment = $_POST['user_id_of_comment'];
    $user_name_of_comment = $_POST['user_name_of_comment'];
    $stmt = $pdo->prepare('INSERT into comments (thecomment, postid, user_id_of_comment, user_name_of_comment) VALUES(?,?,?,?)');
    $stmt->execute([$commentOnPost, $post_id, $user_id_of_comment, $user_name_of_comment]);
}


if (isset($_POST['updateComment'])) {
    $comment_to_edit = $_POST['comment_to_edit'];
    $comment_id = $_POST['comment_id'];

    $stmt = $pdo->prepare("UPDATE comments SET thecomment='$comment_to_edit' WHERE id = ? ");
    $stmt->execute([$comment_id]);
}



if (isset($_POST['deleteComment'])) {
    require "./config/db.php";
    $comment_id = $_POST['comment_id'];
    $stmt = $pdo->prepare("DELETE FROM comments Where id = ? ");
    $stmt->execute([$comment_id]);
}




//=======================================================================================///


if (isset($_SESSION['userId'])) {
    require "./config/db.php";
    $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC ");
    $stmt->execute();
    $posts = $stmt->fetchAll();


    $stmt = $pdo->prepare("SELECT * FROM profileimg WHERE userid = ? ");
    $stmt->execute([$_SESSION['userId']]);
    $profimg = $stmt->fetch();

    // profile Bio
    echo "<div class='UserCrudentials' id='UserCrudentials'>";
    require "./profileImage.php";
    echo " <h3>Biography</h3><H6 class='editBioBtn' >Edit</h6> 
        <p><b>Name</b> $profimg->name</p>
        <p><b>From</b>$profimg->location</p>
        <p><b>Profession</b> $profimg->profession</p>
        <p><b>About</b> $profimg->about</p>
        </div>";



    // edit Biography form and container
    echo   "<div class='editBiographyContain'>
    <form class='editBioForm' action='index.php' method='POST'>
    <ion-icon name='close'></ion-icon>
    <input type='hidden' name='the_id' value='$profimg->userid' >

    <label for='editName'>Name</label> 
    <input type='text' name='editName' id='editLocation'  value='$profimg->name' >

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
    //header('Location: index.php');

    //echo " index line 139 here";



}

?>








<div class="postsContainer">


    <?php if (isset($_SESSION['userId'])) {
        foreach ($posts as $post) { ?>

            <div class='containerDivs'>




                <?php
                $stmt = $pdo->prepare("SELECT * FROM profileimg WHERE userid = ? ");
                $stmt->execute([$post->inputId]);
                $profimg = $stmt->fetch();
                ?>


                <!-- This will give the Profile picture for every post -->
                <a href='posts.php?user=<?php echo $profimg->userid ?>' class='anchorFromImageToSeeProfile'>
                    <img class='imgProf' src='<?php
                                                if ($profimg) {

                                                    if ($profimg->status == 0) {
                                                        echo 'uploads/profileDefault.png';
                                                    } else if ($profimg->status == 1) {
                                                        echo 'uploads/profile' . $profimg->userid . '.' . $profimg->ext . '?' . mt_rand();
                                                    }
                                                } else {
                                                    echo 'uploads/profileDefault.png';
                                                }

                                                ?>' height='60' width='60'>
                </a>





                <h3><?php echo $post->author ?>
                </h3>

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
      <h5 class='comment'>Comment</h5>
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
                    echo   "<P>$post->body</p>
               
                
                ";
                }





                ?>





                <?php if ($_SESSION['userId'] == $post->inputId) { ?>

                    <div class="editAbsoluteDiv">
                        <form class='formToEdit' action="index.php" method="POST">
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



                <!-- Comments start here  -->
                <h5 class='comment'>Comments
                    <?php
                    $postid = $post->id;
                    $stmt = $pdo->prepare("SELECT * FROM comments where postid= ? ");
                    $stmt->execute([$postid]);
                    $comments = $stmt->fetchAll();
                    $num_rows = count($comments);  // same as getting num_rows...

                    echo "(" . $num_rows . ")";


                    ?>

                </h5>
                <div class="comments">

                    <?php

                    $postid = $post->id;
                    $stmt = $pdo->prepare("SELECT * FROM comments where postid= ? ");
                    $stmt->execute([$postid]);
                    $comments = $stmt->fetchAll();
                    foreach ($comments as $comment) {
                        echo "
                    <br><small class='commentUser'>$comment->user_name_of_comment</small>
                    <p>$comment->thecomment</p>";

                        if ($_SESSION['userId'] ==  $comment->user_id_of_comment) {
                            echo "<button class='editBtnForComment'>Edit</button>";
                            //  form for editing the comment 
                            echo " <form action='index.php' method='post' class='editCommentForm'>
                        <input name='comment_to_edit' type='text' class='comment_to_edit_input' value='" . $comment->thecomment . "'>
                        <input name='comment_id' type='hidden' value='" . $comment->id . "'>
                        <input name='updateComment' class='updateCommentBtn' type='submit' value='Save Changes'>
                        <button name='deleteComment' type='submit' class='deleteBtnForComment'>Delete</button>
                        </form>
                        ";
                        }
                    }


                    ?>
                    <h5 class='commentHeading'>Add Comment</h5>
                    <form method='post' action='index.php' class='leaveCommentForm'>
                        <input name='commentOnPost' class='commentOnPostInput' type='text'>
                        <input name='post_id' class='postId' type='hidden' value='<?php echo $post->id ?>'>
                        <input name='user_id_of_comment' type='hidden' value='<?php echo $_SESSION['userId']  ?>'>
                        <input name='user_name_of_comment' type='hidden' value='<?php echo $_SESSION['username']  ?>'>
                        <input type='submit' name='submitComment' class='submitCommentBtn' value='Submit'>
                    </form>

                </div><br>
                <!-- comments end here -->



            </div>

    <?php }
    }  ?>



</div>


<?php require "./includes/footer.php"; ?>