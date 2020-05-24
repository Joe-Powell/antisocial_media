
    <form class="add-post" method="POST" action="post.php" >
       
        <div >
            <input type="hidden" name="author" value="<?php echo  $_SESSION['username'] ?>">
        </div>

        <div class='textAreaDiv'>
            <h2>Add Post</h2>
            <textarea name="body" type='text' > </textarea>
        </div>

        <div >
            <input type="hidden" name="inputId" value="<?php echo $_SESSION['userId']; ?>">
        </div>

            <input type="submit" name="submit" value="Submit" > 

        <form action='upload.php' method='post' enctype='multipart/form-data'> 
            <input type='file' name='file'>  
            <button type='submit' name='uploadFile' >Upload</button> 
            
        </form>



</form >
