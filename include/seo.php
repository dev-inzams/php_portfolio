<?php
require('db.php');


// portfolio setting


if(isset($_POST['update_seo'])){
  $page_title=mysqli_real_escape_string($db,$_POST['page_title']);
  $img_alt=mysqli_real_escape_string($db,$_POST['img_alt']);
  $keywords =mysqli_real_escape_string($db,$_POST['keywords']);
  $page_des= mysqli_real_escape_string($db,$_POST['page_des']);
  
  $filenameOne= time().$_FILES['fav-icon']['name'];
  $file_locOne = $_FILES['fav-icon']['tmp_name'];
  $upload = '../assets/img/';

  if(!empty($filenameOne)){
      move_uploaded_file($file_locOne,$upload.$filenameOne);
    }

 
  

  $query="UPDATE `seo` SET `title`='$page_title',`img_alt`='$img_alt',`fav_icon`='$filenameOne',`page_des`='$page_des',`keywords`='$keywords' WHERE 1";
      $res= mysqli_query($db, $query);
      if($res){
        echo "<script>window.location.href = '../admin/index.php?seosetting=true' </script>";
      }

}


?>