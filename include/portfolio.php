<?php
require('db.php');


// portfolio setting


if(isset($_POST['add_portfolio'])){
  $portfolio_title =  $_POST['portfolio_title'] ;
  $project_client =  $_POST['project_client'] ;
  $project_date = date('d-m-y');
  $project_url =  $_POST['project_url'] ;
  $project_category =  $_POST['project_category'] ;

  $filenameOne = time().$_FILES['portfolio_img_1']['name'];
  $file_locOne = $_FILES['portfolio_img_1']['tmp_name'];

  $filenameTwo = time().$_FILES['portfolio_img_2']['name'];
  $file_locTwo = $_FILES['portfolio_img_2']['tmp_name'];



  $upload = '../assets/img/portfolio/';

  if(!empty($filenameOne)){
      move_uploaded_file($file_locOne,$upload.$filenameOne);
    }

  if(!empty($filenameTwo)){
    move_uploaded_file($file_locTwo,$upload.$filenameTwo);
  }


  

  $query = "INSERT INTO portfolio (portfolio_name,category,client,project_date,project_url,project_img_1,project_img_2) VALUES('$portfolio_title','$project_category', '$project_client', '$project_date','$project_url','$filenameOne', '$filenameTwo')";
      $run = mysqli_query($db, $query);
      if($run){
        echo "<script>window.location.href = '../admin/index.php?portfoliosetting=true' </script>";
      }

};


?>