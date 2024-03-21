<?php
  require('../include/db.php');

  if(isset($_POST['reg'])){
    $query1="SELECT * FROM admin WHERE email='{$_POST['user_email']}'";
    $run1 = mysqli_query($db,$query1);
    $data1 = mysqli_fetch_array($run1);
    if(!empty($data1)>0){
        echo "<script>alert('Email Already register');window.location.href = 'index.php?accountsetting=true?email_already_registerd' ;</script>";
    }else{
      $filenameThree = time().$_FILES['photo']['name'];
      $file_locThree = $_FILES['photo']['tmp_name'];
      $upload = '../images/';
      if(!empty($filenameThree)){
        move_uploaded_file($file_locThree,$upload.$filenameThree);
      }
      $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
      $email = mysqli_real_escape_string($db,  $_POST['user_email']);
      $terms = mysqli_real_escape_string($db, $_POST['terms']);
      $date = date("d-m-y");
      $password = crypt($_POST['user_password'],"DeveloperinZamS2910!");
      $query="INSERT INTO admin (fullname,email,password,profile_photo,role,terms,Date)";
      $query.="VALUES ('$fullname','$email','$password','$filenameThree','user','$terms','$date')";
  
        $run= mysqli_query($db,$query);
        if($run){
        echo "<script>window.location.href='index.php?accountsetting=true';</script>";
          }

    }
  }
  else{
    echo "<script>window.location.href='../index.php';</script>";
  }
?>