<?php
  require('../db.php');

    // portfolio delete

    if(isset($_GET['id'])){
      $ids = $_GET['id'];
      $q = "DELETE FROM portfolio WHERE id=$ids";
      $r = mysqli_query($db,$q);
  
      if($r){
    echo "<script>window.location.href = '../../admin/index.php?portfoliosetting=true' </script>";
      }
    }
?>