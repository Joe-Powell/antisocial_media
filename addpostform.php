

    <form class="add-post" method="POST" action="post.php" enctype='multipart/form-data' >
         <input type="hidden" name="author" value="<?php echo  $_SESSION['username'] ?>">
         <input type="hidden" name="inputId" value="<?php echo $_SESSION['userId']; ?>">
         







       <div class='textAreaDiv'>
            <h2>Add a new post here</h2>
            <textarea name="body" type='text' autofocus> 
            </textarea><br>
            <input type='file' name='file' id='file' hidden="hidden"  >
            <label for="file" class='fileLabel'>Upload Picture</label> 
 
            <input type='file' name='videoFile' id='videoFile' hidden="hidden"  >
            <label for="videoFile" class='fileLabel'>Upload Video</label>  
            
            <span class='spanImageFile'></span> 
            <span class='spanVideoFile'></span> 
            
            <input type="submit" name="submit" value="Submit" id='submit'>
            
            

        </div>


    </form>








         
       