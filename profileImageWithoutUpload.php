<?php



if ($pro->status == 0) {
    echo "<div class='forRelative'>
        <img class='imgProf' id='imgProf' src='uploads/profileDefault.png' height='60' width='60' " . mt_rand() . ">
      
      </div> ";
}

if ($pro->status == 1) { /*this will make sure the cache dont hold the old image */
    echo "<div class='forRelative'>
        <img class='imgProf' id='imgProf' src='uploads/profile" . $pro->userid . "." . $pro->ext . "?" . mt_rand() . " ' height='60' width='60'>
        
     </div> ";
}
