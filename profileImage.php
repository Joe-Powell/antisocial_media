<?php

if ($profimg) {

    if ($profimg->status == 0) {
        echo "<div class='forRelative'>
        <img class='imgProf' id='imgProf' src='uploads/profileDefault.png' height='60' width='60' " . mt_rand() . ">
        <ion-icon name='camera'></ion-icon>
      </div> ";
    }

    if ($profimg->status == 1) { /*this will make sure the cache dont hold the old image */
        echo "<div class='forRelative'>
        <img class='imgProf' id='imgProf' src='uploads/profile" . $profimg->userid . "." . $profimg->ext . "?" . mt_rand() . " ' height='60' width='60'>
        <ion-icon name='camera'></ion-icon>
     </div> ";
    }
} else {
    echo "<div class='forRelative'>
        <img class='imgProf' id='imgProf' src='uploads/profileDefault.png' height='60' width='60' " . mt_rand() . ">
        <ion-icon name='camera'></ion-icon>
     </div> ";
}

echo "  <form class='profileUploadForm' id='profileUploadForm' method='post' action='posts.php' enctype='multipart/form-data'>
<input type='file' name='profileUpload' id='profileUpload' hidden='hidden'>
<label for='profileUpload' class='profileUploadLabel' id='profileUploadLabel' hidden='hidden'>Select Profile Picture</label><br>
<input type='submit' name='submit_new_pro_pic' id='submit_new_pro_pic' value='Insert uploaded picture'>
</form>";
