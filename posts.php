  if($post->video !== '' && $post->image !== '.') {
      echo   "<P>$post->body</p>
      <img src='uploads/".$post->image."' height='100' width='100'>

      <video width='300' height='210' controls>
      <source src='uploadVideos/".$post->video."' type='video/mp4'>
      </video>
      ";  
    
  }
    elseif($post->video !== '') {
        echo   "<P>$post->body</p>
        <video width='300' height='210' controls>
        <source src='uploadVideos/".$post->video."' type='video/mp4'>
        </video>";  
      
    }
    elseif($post->image !== '.') {
      echo   "<P>$post->body</p>
      <img src='uploads/".$post->image."' height='100' width='100'>
      
      ";  
    
  }
    
     
