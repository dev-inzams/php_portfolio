<?php
  require('db.php');
  if(isset($_SESSION['isUserLoggedIn'])){
    echo "<script>window.location.href = '../index.php' </script>";
  }

  if(isset($_POST['login'])){
    $email =mysqli_real_escape_string($db, $_POST['email'] ) ;
    $password = crypt($_POST['password'],"DeveloperinZamS2910!");
    $query = "SELECT * FROM admin WHERE email= '$email' && password= '$password'";
    $run = mysqli_query($db, $query);
    $data = mysqli_fetch_array($run);
    if(!empty($data)>0){
      $_SESSION['isUserLoggedIn']=true;
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['role'] = $data['role'];
      
      if($data['role']!="admin"){
        echo "<script>window.location.href = '../index.php' ;</script>";
      }
      if($data['role']=="admin"){
        echo "<script>window.location.href = '../admin/index.php' ;</script>";
      }


    }else{
        echo "<script>alert('Username or Password wrong');window.location.href = '../index.php' ;</script>";
    }
  }
?>

