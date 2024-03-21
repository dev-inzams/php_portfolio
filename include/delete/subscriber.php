<?php
  require('../db.php');

    // menu delete

    if(isset($_GET['id'])){
      $ids = $_GET['id'];
      $q = "DELETE FROM `subscribe` WHERE id=$ids";
      $r = mysqli_query($db,$q);
  
      if($r){
    echo "<script>window.location.href = '../../admin/index.php' </script>";
      }
    }
?>