<?php
  require('db.php');



// home setting

if(isset($_POST['update_home'])){
  $title = mysqli_real_escape_string($db, $_POST['title']) ;
  $subtitle = mysqli_real_escape_string($db, $_POST['subtitle']) ;
  $show_icons = $_POST['show_icons'] ?? 0;
 

  $query = "UPDATE home SET ";
  $query.="title= '$title',";
  $query.="subtitle= '$subtitle',";
  $query.="show_icons= '$show_icons' WHERE id=1";

  $run = mysqli_query($db,$query);
  if($run){
    echo "<script>window.location.href = '../admin/index.php?homesetting=true' </script>";
  }
  

}

// about setting

if(isset($_POST['update_about'])){
  $about_title = mysqli_real_escape_string($db, $_POST['about_title']) ;
  $about_subtitle = mysqli_real_escape_string($db, $_POST['about_subtitle']) ;
  $about_short_description = mysqli_real_escape_string($db, $_POST['about_short_description']) ;
  $about_description = mysqli_real_escape_string($db, $_POST['about_description']) ;
  
  $image_name = time().$_FILES['about_profile']['name'];
  $image_temp = $_FILES['about_profile']['tmp_name'];
  if($image_temp==''){
    $q = 'SELECT * FORM about_page WHERE 1';
    $r = mysqli_query($db, $q);
    $d = mysqli_fetch_array($r);
    $image_name = $d['about_profile'];
  }
  
  if(move_uploaded_file($image_temp, "../images/$image_name")){
      $query = "UPDATE about_page SET ";
      $query.="about_title= '$about_title',";
      $query.="about_subtitle= '$about_subtitle',";
      $query.="about_short_description= '$about_short_description',";
      $query.="about_profile= '$image_name',";
      $query.="about_description= '$about_description' WHERE id=1";

      $run = mysqli_query($db,$query);
      if($run){
        echo "<script>window.location.href = '../admin/index.php?aboutsetting=true' </script>";
      }
    }
}

// skill setting

if(isset($_POST['add_skill'])){
  $skill_name =  $_POST['skill_name'] ;
  $skill_lavel = $_POST['skill_lavel'] ;
  $skill_color = $_POST['skill_color'];
 

  $query = "INSERT INTO skill (skill_name,skill_label,color_code) VALUES('$skill_name', '$skill_lavel', '$skill_color')";
  $run = mysqli_query($db,$query);
  if($run){
    echo "<script>window.location.href = '../admin/index.php?aboutsetting=true' </script>";
  }
  

}


// menu setting

if(isset($_POST['add_menu'])){
  $menu_name =  $_POST['menu_name'] ;
  $menu_link = $_POST['menu_link'] ;
  $menu_icon = $_POST['menu_icon'];
 

  $query = "INSERT INTO menu (menu_name,menu_link,menu_icon) VALUES('$menu_name', '$menu_link', '$menu_icon')";
  $run = mysqli_query($db,$query);
  if($run){
    echo "<script>window.location.href = '../admin/index.php?menusetting=true' </script>";
  }
  

}

// personal info one

if(isset($_POST['add_personal_info_1'])){
  $info_name_1 =  $_POST['info_name_1'] ;
  $info_value_1 = $_POST['info_value_1'] ;
  
 

  $query = "INSERT INTO personal_info (personal_info_label,personal_info_value) VALUES('$info_name_1','$info_value_1')";
  $run = mysqli_query($db,$query);
  if($run){
    echo "<script>window.location.href = '../admin/index.php?aboutsetting=true' </script>";
  }
}


// personal info two

if(isset($_POST['add_personal_info_2'])){
  $info_name_2 =  $_POST['info_name_2'] ;
  $info_value_2 = $_POST['info_value_2'] ;
  
 

  $query = "INSERT INTO personal_info_2 (personal_info_label,personal_info_value) VALUES('$info_name_2','$info_value_2')";
  $run = mysqli_query($db,$query);
  if($run){
    echo "<script>window.location.href = '../admin/index.php?aboutsetting=true' </script>";
  }
}

// account update
if(isset($_POST['update_about_conunter'])){
  $hp_c = $_POST['happy_client'];
  $p =  $_POST['project'];
  $r =  $_POST['review'] ;
  $a =  $_POST['award'] ;

  $query = "UPDATE `about_counter` SET `happy_clients`='$hp_c',`complete_project`='$p',`review`='$r',`award`='$a' WHERE 1";

  $run = mysqli_query($db,$query);
  if($run){
    echo "<script>window.location.href = '../admin/index.php?aboutsetting=true' </script>";
  }
  

}

// portfolio setting


if(isset($_POST['add_testmonial'])){
  $client_pro =  $_POST['client_pro'] ;
  $review =  $_POST['review'] ;
  $names =  $_POST['client_name'] ;

  
  $filenameOne = time().$_FILES['client_img']['name'];
  $file_locOne = $_FILES['client_img']['tmp_name'];

  $upload = '../assets/img/testimonials/';

  if(!empty($filenameOne)){
      move_uploaded_file($file_locOne,$upload.$filenameOne);
    }
  

  $query = "INSERT INTO `testmonial`(`review`, `client_img`, `client_pro`, `name`) VALUES ('$review','$filenameOne','$client_pro','$names')";
      $run = mysqli_query($db,$query);
      if($run){
        echo "<script>window.location.href = '../admin/index.php?aboutsetting=true' </script>";
      }
}


// account update
if(isset($_POST['update_profile'])){
  $profile_name = mysqli_real_escape_string($db, $_POST['profile_name']) ;
  $profile_email = mysqli_real_escape_string($db, $_POST['profile_email']) ;
  $password = mysqli_real_escape_string($db, $_POST['password']) ;
  
  $filenameThree = time().$_FILES['profile_photo']['name'];
  $file_locThree = $_FILES['profile_photo']['tmp_name'];

  $upload = '../images/';

  if(!empty($filenameThree)){
      move_uploaded_file($file_locThree,$upload.$filenameThree);
    }
 

  $query = "UPDATE admin SET ";
  $query.="fullname= '$profile_name',";
  $query.="email= '$profile_email',";
  $query.="password= '$password',";
  $query.="profile_photo= '$filenameThree' WHERE id=1";

  $run = mysqli_query($db,$query);
  if($run){
    echo "<script>window.location.href = '../admin/index.php?accountsetting=true' </script>";
  }
  

}


// add user
if(isset($_POST['reg'])){
  $query1="SELECT * FROM admin WHERE email='{$_POST['user_email']}'";
  $run1 = mysqli_query($db,$query1);
  $data1 = mysqli_fetch_array($run1);
  
  
  if(!empty($data1)>0){
      echo "<script>alert('Email Already register');window.location.href = '../index.php' ;</script>";
  }else{
    $_SESSION['isUserLoggedIn']=true;
    $_SESSION['email'] = $_POST['user_email'];

    $filenameThree = time().$_FILES['user_photo']['name'];
    $file_locThree = $_FILES['user_photo']['tmp_name'];

    $upload = '../images/';
    if(!empty($filenameThree)){
      move_uploaded_file($file_locThree,$upload.$filenameThree);
    }

    $password = crypt($_POST['user_password'],"DeveloperinZamS2910!");
    $query="INSERT INTO admin (email,password,fullname,role,profile_photo)";
    $query.="VALUES ('{$_POST['user_email']}','$password','{$_POST['user_fullname']}', 'user','$filenameThree')";

      $run= mysqli_query($db,$query);
      if($run){
      echo "<script>window.location.href='../admin/index.php';</script>";
        }

  }
}

// add resume
  if(isset($_POST['add_resume'])){
    $type = $_POST['type'];
    $title = $_POST['Title'];
    $time = $_POST['Time'];
    $Organaigetion = $_POST['Organaigetion'];
    $About = $_POST['About'];

    $query = "INSERT INTO resume (type,title,time,organation,about_ex) VALUES('$type','$title','$time','$Organaigetion','$About')";
    $run = mysqli_query($db, $query);
    if($run){
      echo "<script>window.location.href='../admin/index.php?resumesetting';</script>";
      }
  }


  // contact update
if(isset($_POST['update_contact'])){
  $address =mysqli_real_escape_string($db, $_POST['address']);
  $email =mysqli_real_escape_string($db, $_POST['email']);
  $call_no = mysqli_real_escape_string($db,$_POST['call_no']);
  


  $query = "UPDATE `contact` SET `address`='$address',`email`='$email',`call`='$call_no' WHERE 1";

  $run = mysqli_query($db,$query);
  if($run){
    echo "<script>window.location.href = '../admin/index.php?contactsetting=true' </script>";
  }
  
}


// subscribe
if(isset($_POST['subscribe'])){
  $emaill = mysqli_real_escape_string($db, $_POST['email']) ;

  $check_emai ="SELECT * FROM `subscribe` WHERE email='$emaill'";
  $run_che_email = mysqli_query($db,$check_emai);
  $data = mysqli_fetch_array($run_che_email);

  if(!empty($data)>0){
    echo "<script>alert('Email Already Exist');</script>";
    echo "<script>window.location.href = '../index.php' </script>";
  }else{
    $query = "INSERT INTO `subscribe`(`email`) VALUES ('$emaill')";
    $run = mysqli_query($db,$query);
    if($run){
      echo "<script>alert('subscribe done');</script>";
      echo "<script>window.location.href = '../index.php' </script>";
    }
  } 

}




?>
