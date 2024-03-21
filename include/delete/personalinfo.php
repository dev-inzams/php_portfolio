<?php
  require('../db.php');

    // personal info delete

    if(isset($_GET['id'])){
      $ids = $_GET['id'];
      $q = "DELETE FROM personal_info WHERE id=$ids";
      $r = mysqli_query($db,$q);
  
      if($r){
    echo "<script>window.location.href = '../../admin/index.php?aboutsetting=true' </script>";
      }
    }
     // personal info two delete
     if(isset($_GET['id'])){
      $ids = $_GET['id'];
      $q = "DELETE FROM personal_info_2 WHERE id=$ids";
      $r = mysqli_query($db,$q);
  
      if($r){
        echo "<script>window.location.href = '../../admin/index.php?aboutsetting=true' </script>";
      }
    }
?>