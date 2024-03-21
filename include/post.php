<?php
require('db.php');


// post setting


if(isset($_POST['add_post'])){
  $title = mysqli_real_escape_string($db,$_POST['title']);
  $description = mysqli_real_escape_string($db,$_POST['description']);
  $description_2 = mysqli_real_escape_string($db,$_POST['description_2']);
  $post_date=date('d-m-y');
  $filenameTwo= mysqli_real_escape_string($db,$_POST['video_src']);
  
  $filenameOne= time().$_FILES['thumbnail']['name'];
  $file_locOne = $_FILES['thumbnail']['tmp_name'];

   $upload = '../assets/img/post/';

   if(!empty($filenameOne)){
       move_uploaded_file($file_locOne,$upload.$filenameOne);
     }

  

   $query="INSERT INTO `post`(`title`, `thumbanail`, `description`, `image_1`, `description_2`, `date`) VALUES ('$title','$filenameOne','$description','$filenameTwo','$description_2','$post_date')";

      $res= mysqli_query($db,$query);
      if($res){
        echo "<script>window.location.href = '../admin/index.php?postsetting=true' </script>";
      }

}


?>