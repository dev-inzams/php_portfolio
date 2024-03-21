<?php
  require('../db.php');

    // user info delete

    if(isset($_GET['id'])){
      $ids = $_GET['id'];
      $q = "DELETE FROM admin WHERE id=$ids";
      $r = mysqli_query($db,$q);
  
      if($r){
    echo "<script>window.location.href = '../../admin/index.php?accountsetting=true' </script>";
      }
    }
?>