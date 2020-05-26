
     <form class="add-post" method="POST" action="post.php" >
         <input type="hidden" name="author" value="<?php echo  $_SESSION['username'] ?>">
       

        <div class='textAreaDiv'>
            <h2>Add a new post here</h2>
            <textarea name="body" type='text' >
            </textarea>
            <input type="submit" name="submit" value="Submit" > 

        </div>

        <input type="hidden" name="inputId" value="<?php echo $_SESSION['userId']; ?>">

    </form>
