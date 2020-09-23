

    <form class="add-post" method="POST" action="post.php" enctype='multipart/form-data' >
         <input type="hidden" name="author" value="<?php echo  $_SESSION['username'] ?>">
         <input type="hidden" name="inputId" value="<?php echo $_SESSION['userId']; ?>">
         

        <div class='textAreaDiv'>
            <h2>Add a new post here</h2>
            <textarea name="body" type='text' autofocus> 
            </textarea><br>

            <div class="buttons">
                <input class='uploadPicture' type='file' name='file' id='file' hidden="hidden"  >
                <label for="file" name='uploadPicture' class='fileLabel'>Upload Picture</label> 
    
                <input type='file' name='videoFile' id='videoFile' hidden="hidden"  >
                <label for="videoFile" class='fileLabel'>Upload Video</label><br> 

               
                
               
                
                <input class='submitUpload' type="submit" name="submit" value="Submit" id='submitUpload'>
            </div>  

        </div>
        <h2 class='spanImageFile'><?php if(isset($_FILES["file"]))
                 { 
                    $file = $_FILES["file"];
                    $fileName = $file['name'];
                    echo "Thanks for uploading: " . $fileName;
                
                } else {
                    echo ""; 
                }
                  ?> 
            </h2>

       

    </form>


    <script>

        /// tryint to get the filename before uploading... NOT WORKING
        document.querySelector('.fileLabel').addEventListener('click', () => {
          let uploadPictureValue = document.querySelector('.uploadPicture').value;
            document.querySelector('.spanImageFile').innerHTML= uploadPictureValue;
            
        })


    </script>

  







         
       