<?php
require('../include/db.php');
if(!isset($_SESSION['isUserLoggedIn'])){
    echo "<script>window.location.href = 'login.php' </script>";
}
elseif($_SESSION['role']!='admin'){
  echo "<script>window.location.href = '../index.php' </script>";
}

$query= 'SELECT * FROM admin, social_media, about_page, personal_info, skill, seo';
$run = mysqli_query($db,$query);
$user_data_admin = mysqli_fetch_array($run);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel | Overview</title>
  <?php
  $query = "SELECT * FROM `seo` WHERE 1";
  $run = mysqli_query($db, $query);
  $seo = mysqli_fetch_array($run);
  ?>
  <link href="../../assets/img/<?= $seo['fav_icon']?>" rel="icon">
  <!--bs-->
  <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">-->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">



  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php#contact" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <?php
          $query = "SELECT * FROM `contact_from` LIMIT 3";
          $run = mysqli_query($db, $query);
          while ($contact_noti = mysqli_fetch_array($run)){
          ?>
          <a href="index.php?contact_id=<?= $contact_noti['id']?>" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                <?= $contact_noti['name']?>
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm"><?= $contact_noti['subject']?></p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i><?= $contact_noti['date']?></p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <?php }?>
          <div class="dropdown-divider"></div>
          <a href="index.php?all_contact" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
    <?php
      $query = "SELECT * FROM `seo` WHERE 1";
      $run = mysqli_query($db, $query);
      $seo_l = mysqli_fetch_array($run);
    ?>
      <img src="../assets/img/<?= $seo_l['fav_icon']?>" alt="<?= $seo_l['img_alt']?>" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../images/<?=$user_data_admin['profile_photo']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php" class="d-block"><?= $user_data_admin['fullname']?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard</p>
            </a>
          </li>

          <!-- home setting -->
          <?php
             if(isset($_GET['homesetting'])){
              $active = 'bg-success';
            }else{$active = '';}?>
          <li class="nav-item <?php echo $active; ?>">
            <a href="index.php?homesetting=true" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p> Home Setting </p>
            </a>
          </li>

          <!-- home setting -->
            <?php
             if(isset($_GET['aboutsetting'])){
              $activeaa = 'bg-success';
             }else{$activeaa = '';}?>
          <li class="nav-item <?php echo $activeaa;?>">
            <a href="index.php?aboutsetting=true" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>About Setting</p>
            </a>
          </li>

          <!-- resumesetting setting -->
          <?php
             if(isset($_GET['resumesetting'])){
              $activer = 'bg-success';
             }else{$activer = '';}?>
          <li class="nav-item <?php echo $activer;?>">
            <a href="index.php?resumesetting=true" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Resume Setting</p>
            </a>
          </li>

          <!-- portfoliosetting setting -->
          <?php
             if(isset($_GET['portfoliosetting'])){
              $activep = 'bg-success';
             }else{$activep = '';}?>
          <li class="nav-item <?php echo $activep;?>">
            <a href="index.php?portfoliosetting=true" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p> Portfolio Setting</p>
            </a>
          </li>

          <!-- contactsetting setting -->
          <?php
             if(isset($_GET['contactsetting'])){
              $activec = 'bg-success';
             }else{$activec = '';}?>
          <li class="nav-item <?php echo $activec;?>">
            <a href="index.php?contactsetting=true" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Contact Setting</p>
            </a>
          </li>

          <!-- seosetting setting -->
          <?php
             if(isset($_GET['seosetting'])){
              $actives = 'bg-success';
             }else{$actives = '';}?>
          <li class="nav-item <?php echo $actives;?>">
            <a href="index.php?seosetting=true" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p> SEO Setting</p>
            </a>
          </li>

          <!-- menusetting setting -->
          <?php
             if(isset($_GET['menusetting'])){
              $activem = 'bg-success';
             }else{$activem = '';}?>
          <li class="nav-item <?php echo $activem;?>">
            <a href="index.php?menusetting=true" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Menu Setting</p>
            </a>
          </li>

          <!-- accountsetting setting -->
          <?php
             if(isset($_GET['accountsetting'])){
              $activea = 'bg-success';
             }else{$activea = '';}?>
          <li class="nav-item <?php echo $activea;?>">
            <a href="index.php?accountsetting=true" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Account Setting</p>
            </a>
          </li>

          <!-- postsetting setting -->
            <?php
             if(isset($_GET['postsetting'])){
              $activepost = 'bg-success';
             }else{$activepost = '';}?>
          <li class="nav-item <?php echo $activepost;?>">
            <a href="index.php?postsetting=true" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Post 
              </p>
            </a>
          </li>

         
          <li class="nav-item">
            <a href="../include/logout.php" class="nav-link bg-danger" role="button">
              <i class="nav-icon fas fa-sign-out-alt text-light"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <?php
              if(isset($_GET['homesetting'])){
                ?>
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <?php
              }?>

              <?php
              if(isset($_GET['aboutsetting'])){ ?>
              <li class="breadcrumb-item"><a href="#">About</a></li>
              <?php }?>

              <?php
              if(isset($_GET['resumesetting'])){ ?>
              <li class="breadcrumb-item"><a href="#">Resume</a></li>
              <?php }?>

              <?php
              if(isset($_GET['portfoliosetting'])){ ?>
              <li class="breadcrumb-item"><a href="#">Portfolio</a></li>
              <?php }?>

              <?php
              if(isset($_GET['contactsetting'])){ ?>
              <li class="breadcrumb-item"><a href="#">Contact</a></li>
              <?php }?>

              <?php
              if(isset($_GET['seosetting'])){ ?>
              <li class="breadcrumb-item"><a href="#">SEO</a></li>
              <?php }?>

              <?php
              if(isset($_GET['menusetting'])){ ?>
              <li class="breadcrumb-item"><a href="#">Menu</a></li>
              <?php }?>

              <?php
              if(isset($_GET['accountsetting'])){ ?>
              <li class="breadcrumb-item"><a href="#">Account</a></li>
              <?php }?>

              <?php
              if(isset($_GET['postsetting'])){ ?>
              <li class="breadcrumb-item"><a href="#">post</a></li>
              <?php }?>
              
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- /.content-header -->
    <!-- /.content-header -->
    <!-- /.content-header -->

<!-- home setting -->
    <?php
      if(isset($_GET['homesetting'])){ ?>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update Home Setting</h3>
      </div>
              <!-- /.card-header -->
              <!-- form start -->
      <form action="../include/admin.php" method="post">
        <div class="card-body">
          <?php
          $query = "SELECT * FROM `home` WHERE 1";
          $run = mysqli_query($db, $query);
          $home_data = mysqli_fetch_array($run);
          ?>
         <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input name="title" type="text" value="<?=$home_data['title']?>" class="form-control" id="exampleInputEmail1" placeholder="Enter your name or headline">
         </div>

         <div class="form-group">
          <label for="exampleInputPassword1">Subtitle</label>
          <input name="subtitle" type="text" value="<?=$home_data['subtitle']?>" class="form-control" id="exampleInputPassword1" placeholder="Enter your subtitle">
         </div>

       

         <div class="form-check">
          <input name="show_icons" type="checkbox" class="form-check-input" id="exampleCheck1"
          <?php
          if($home_data['show_icons']){
            echo 'checked';
          }
        ?>
          
          >
           <label class="form-check-label" for="exampleCheck1" >Show Social Icons</label>
         </div>
         </div>
                <!-- /.card-body -->

         <div class="card-footer">
           <button type="submit" name="update_home" class="btn btn-primary">Submit</button>
         </div>
      </form>
    </div>
<!-- close home setting -->

<!-- about about setting -->
     <?php
      }else if(isset($_GET['aboutsetting'])){
        ?>
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Update About Setting</h3>
          </div>
              <!-- /.card-header -->
              <!-- form start -->
          <form action="../include/admin.php" method="post" enctype="multipart/form-data">
            <div class="card-body">

            <div class="form-group">
                <label for="exampleInputEmail1">About Title</label>
                <input name="about_title" type="text" value="<?=$user_data_admin['about_title']?>" class="form-control" id="exampleInputEmail1" placeholder="Enter your name or headline">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">About Subtitle</label>
              <input name="about_subtitle" type="text" value="<?=$user_data_admin['about_subtitle']?>" class="form-control" id="exampleInputPassword1" placeholder="Enter your subtitle">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">About Short Description</label>
              <input name="about_short_description" type="text" value="<?=$user_data_admin['about_short_description']?>" class="form-control" id="exampleInputPassword1" placeholder="Enter your subtitle">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">About Description</label>
              <input name="about_description" type="text" value="<?=$user_data_admin['about_description']?>" class="form-control" id="exampleInputPassword1" placeholder="Enter your subtitle">
            </div>

            <div class="form-group">
              <img src="../images/<?=$user_data_admin['about_profile']?>" height="100px" width="100px">
                  </br><label for="exampleInputFile">Profile Photo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="about_profile" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
            </div>
         </div>
                    <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" name="update_about" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>

        <!-- skils -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Update skils Setting</h3>
          </div>
              <!-- /.card-header -->
          <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All Skils</h3>

                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width: 10%">#</th>
                        <th style="width: 30%">Skill Name</th>
                        <th>Skill Color</th>
                        <th style="width: 10%">Skill Lavel</th>
                        <th style="width: 15%">Delete Skill</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $query_4= 'SELECT * FROM  skill';
                      $run_4 = mysqli_query($db,$query_4);
                      $c=1;
                      while($skill = mysqli_fetch_array($run_4)){
                    ?>
                    <tr>
                      <td><?= $c?></td>
                      <td><?= $skill['skill_name']?></td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar" style="background-color: <?=$skill['color_code']?>; width: <?=$skill['skill_label']?>%"></div>
                        </div>
                      </td>
                        <td><span class="badge" style="background-color: <?=$skill['color_code']?>;"><?=$skill['skill_label']?></span></td>
                        
                        <td><a href="../include/delete/skill.php?id=<?= $skill['id']?>">Delete</a></td>
                        </tr>  
                          <?php
                          $c++;
                        }
                      ?>
                      
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
          </div>
              <!-- form start -->
          <form action="../include/admin.php" method="post">
            <div class="card-body col-md-12">

            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Skil Name</label>
                <input name="skill_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your Skill Name">
            </div>

            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Skil Lavel Color</label>
                <input name="skill_color" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your Skill Name">
            </div>

            <div class="form-group col-md-12">
              <label for="exampleInputPassword1">skill Lavel</label>
              <input name="skill_lavel" min="1" max="100" type="range" class="form-control" id="exampleInputPassword1"">
            </div>
                    <!-- /.card-body -->

            <div class="card-footer col-md-12">
              <button type="submit" name="add_skill" class="btn btn-primary">Add Skill</button>
            </div>
          </form>
        </div>
        <!-- close skils -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Update Personal Information</h3>
          </div>
        </div>
        <!-- Personal Information -->
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Personal Information ONE</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>INFO Name</th>
                      <th>INFO Value</th>
                      <th style="width: 40px">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $query_4= 'SELECT * FROM  personal_info';
                      $run_4 = mysqli_query($db,$query_4);
                      $p=1;
                      while($personal_info = mysqli_fetch_array($run_4)){
                    ?>
                    <tr>
                      <td><?= $p?></td>
                      <td><?= $personal_info['personal_info_label']?></td>
                      <td><?= $personal_info['personal_info_value']?></td>
                      <td><span class="badge bg-danger"><a href="../include/delete/personalinfo.php?id=<?= $personal_info['id']?>">Delete</a></span></td>
                    </tr>
                    <?php
                          $p++;
                        }
                      ?>
                  </tbody>
                </table>
              </div><!-- /.card-body -->
            </div><!-- /.card -->
            

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Personal Information One</h3>
              </div>
              <!-- /.card-header -->
            <div class="card-body p-0">
                <form action="../include/admin.php" method="post" class="card-body">
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">INFO Label</label>
                    <input name="info_name_1" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your Information">
                  </div>

                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">INFO Value</label>
                    <input name="info_value_1" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your Information Value">
                  </div>
                      <!-- /.card-body -->
                  <div class="card-footer col-md-12">
                    <button type="submit" name="add_personal_info_1" class="btn btn-primary">Add Information</button>
                  </div>
                </form>
            </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
          
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Personal Information TWO</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>INFO Name</th>
                      <th>INFO Value</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php 
                      $query_4= 'SELECT * FROM  personal_info_2';
                      $run_4 = mysqli_query($db,$query_4);
                      $p=1;
                      while($personal_info_2 = mysqli_fetch_array($run_4)){
                    ?>
                     <tr>
                      <td><?= $p?></td>
                      <td><?= $personal_info_2['personal_info_label']?></td>
                      <td><?= $personal_info_2['personal_info_value']?></td>
                      <td><span class="badge bg-danger"><a href="../include/delete/personalinfo.php?id=<?= $personal_info_2['id']?>">Delete</a></span></td>
                    </tr>
                    <?php
                          $p++;
                        }
                      ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Personal Information Two</h3>
              </div>
              <!-- /.card-header -->
          <form action="../include/admin.php" method="post">
            <div class="card-body col-md-12">

            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">INFO Label</label>
                <input name="info_name_2" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your Information">
            </div>

            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">INFO Value</label>
                <input name="info_value_2" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your Information Value">
            </div>
                    <!-- /.card-body -->
            <div class="card-footer col-md-12">
              <button type="submit" name="add_personal_info_2" class="btn btn-primary">Add Information</button>
            </div>
          </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- close Personal Information -->
        <!-- testmonial -->
    <div class="card col-md-12">
      <div class="card-header bg-info">
       <h3 class="card-title">Add Testimonial</h3>
      </div>
      <form action="../include/admin.php" method="post" enctype="multipart/form-data">
        <div class="card-body col-md-12">
        <div class="row">
          <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Client Image</label>
          <input name="client_img" type="file" class="form-control" id="exampleInputEmail1" placeholder="Client Image">
          </div>

          <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Client Profession</label>
          <input name="client_pro" type="text" class="form-control" id="exampleInputEmail1" placeholder="Client Profession">
          </div>
        </div>

        <div class="form-group col-md-12">
          <label for="exampleInputEmail1">Client Review</label>
          <textarea name="review" class="form-control" id="exampleInputEmail1" placeholder="Client Review"></textarea>
        </div>
        <div class="form-group col-md-12">
          <label for="exampleInputEmail1">Client Name</label>
          <input type="text" name="client_name" class="form-control" id="exampleInputEmail1" placeholder="Client Name">
        </div>
                    <!-- /.card-body -->
        <div class="card-footer col-md-12">
         <button type="submit" name="add_testmonial" class="btn btn-primary">Add Testmonial</button>
         </div>
      </form>
    </div>

            <!-- about client area -->
            <div class="card col-md-12">
      <div class="card-header bg-info">
       <h3 class="card-title">About Conunter Area</h3>
      </div>
      <?php
      $query ="SELECT * FROM `about_counter` WHERE 1";
      $run = mysqli_query($db, $query);
      $abc = mysqli_fetch_array($run);
      ?>
      <form action="../include/admin.php" method="post">
        <div class="card-body col-md-12">
        <div class="row">
          <div class="form-group col-md-3">
          <label for="exampleInputEmail1">Happy Client</label>
          <input name="happy_client" type="text" class="form-control" id="exampleInputEmail1" value="<?= $abc['happy_clients'];?>">
          </div>

          <div class="form-group col-md-3">
          <label for="exampleInputEmail1">Project</label>
          <input name="project" type="text" class="form-control" id="exampleInputEmail1" value="<?= $abc['complete_project'];?>">
          </div>
       

          <div class="form-group col-md-3">
            <label for="exampleInputEmail1">Fiverr Review</label>
            <input type="text" name="review" class="form-control" id="exampleInputEmail1" value="<?= $abc['review'];?>">
          </div>
          <div class="form-group col-md-3">
            <label for="exampleInputEmail1">Award</label>
            <input type="text" name="award" class="form-control" id="exampleInputEmail1" value="<?= $abc['award'];?>">
          </div>
        </div>
                    <!-- /.card-body -->
        <div class="card-footer col-md-12">
         <button type="submit" name="update_about_conunter" class="btn btn-primary">Update Area</button>
         </div>
      </form>
    </div>
<!--close about setting -->


<!-- Resume setting -->
        <?php
      }else if(isset($_GET['resumesetting'])){
        ?>
      <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title mt-2">Education</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 20px">Title</th>
                      <th style="width: 10px">Time</th>
                      <th>Organation</th>
                      <th>About</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $query = "SELECT * FROM resume WHERE type='e'";
                      $run = mysqli_query($db, $query);
                      while($resume =mysqli_fetch_array($run)){
                    ?>
                    <tr>
                      <td><?= $resume['title']?></td>
                      <td><?= $resume['time']?></td>
                      <td><?= $resume['organation']?></td>
                      <td><?= $resume['about_ex']?></td>
                      <td><span class="badge bg-danger"><a href="../include/delete/resume.php?id=<?= $resume['id']?>">Delete</a></span></td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div><!-- /.card-body -->
            </div><!-- /.card -->
        <!-- add any iteam -->
          </div><!-- /.col -->
          
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Professional Experience</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 20px">Title</th>
                      <th style="width: 10px">Time</th>
                      <th>Organation</th>
                      <th>About</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $query = "SELECT * FROM resume WHERE type='p'";
                      $run = mysqli_query($db,$query);
                      while($resume = mysqli_fetch_array($run)){
                    ?>
                    <tr>
                      <td><?= $resume['title']?></td>
                      <td><?= $resume['time']?></td>
                      <td><?= $resume['organation']?></td>
                      <td><?= $resume['about_ex']?></td>
                      <td><span class="badge bg-danger"><a href="../include/delete/resume.php?id=<?= $resume['id']?>">Delete</a></span></td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>


        <div class="card col-md-12">
              <div class="card-header bg-info">
              <h3 class="card-title ">Add Resume</h3>
           </div>
              <!-- /.card-header -->
          <form action="../include/admin.php" method="post">
            <div class="card-body col-md-12">
            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Type</label>
                <select name="type"  class="form-control" id="exampleInputEmail1" placeholder="Type">
                  <option value="e">Education</option>
                  <option value="p">Professional</option>
                </select>
            </div>

            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Title</label>
                <input name="Title" type="text" class="form-control" id="exampleInputEmail1" placeholder="Title">
            </div>

            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Time</label>
                <input name="Time" type="date" class="form-control" id="exampleInputEmail1" placeholder="Time">
            </div>

            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Organaigetion</label>
                <input name="Organaigetion" type="text" class="form-control" id="exampleInputEmail1" placeholder="Organaigetion">
            </div>

            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">About</label>
                <textarea name="About" class="form-control" id="exampleInputEmail1" placeholder="About"></textarea>
            </div>
                    <!-- /.card-body -->
            <div class="card-footer col-md-12">
              <button type="submit" name="add_resume" class="btn btn-primary">Add Resume</button>
            </div>
          
              <!-- /.card-body -->
            </div>
          </form>
            <!-- /.card -->
          </div>
<!-- Close resume setting -->

<!-- portfolio setting -->
        <?php
      }else if(isset($_GET['portfoliosetting'])){
        ?>
  <section class="portfolio">
              <!-- form start -->
          <form action="../include/portfolio.php" method="post" enctype="multipart/form-data">
            <div class="card-body">

            <div class="form-group">
                <label for="exampleInputEmail1">Project Title</label>
                <input name="portfolio_title" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter project title">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Client Name</label>
              <input name="project_client" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter your subtitle">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Project URL</label>
              <input name="project_url" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Project URL">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Project Categories</label>
              <input name="project_category" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Project URL">
            </div>


            <div class="form-group">
                  <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                        <input name="portfolio_img_1" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
            </div>

            <div class="form-group">
                  <label for="exampleInputFile">Image 2</label>
                    <div class="input-group">
                        <input name="portfolio_img_2" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
            </div>


            </div>
                    <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" name="add_portfolio" class="btn btn-primary">Add Portfolio</button>
            </div>
          </form>
            <!-- Default box -->
            <div class="card">
             <div class="card-header">
               <h3 class="card-title">Projects</h3>
              
                 <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                     </button>
                     <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                      </button>
                  </div>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped projects">
                  <thead>
                    <tr>
                       <th style="width: 1%"> #</th>
                        <th style="width: 15%">Project Name</th>
                        <th style="width: 20%">Image</th>
                        <th style="width: 5%">Client</th>
                        <th style="width: 5%">URL</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      // pagination
                      $sql1 = "SELECT * FROM  portfolio";
                      $run_sql1 = mysqli_query($db,$sql1);
                      $num_rows = mysqli_num_rows($run_sql1);

                      $devide_num = ($num_rows/5)+1;

                      if(isset($_GET['page'])){
                        $get_page_no = $_GET['page'];
                        $offset = ($get_page_no-1)*5;

                        $get_page_no_decrement = ($get_page_no-1);
                        $get_page_no_increment = ($get_page_no+1);

                      }else{
                        $offset = 0;
                        $get_page_no=0;
                      }
                      // just show data
                      $query_portfolio= "SELECT * FROM  portfolio LIMIT 5 OFFSET $offset";
                      $run_portfolio = mysqli_query($db,$query_portfolio);
                      $p=1;
                      while($portfolio = mysqli_fetch_array($run_portfolio)){
                    ?>
                    <tr>
                       <td><?= $p?></td>
                        <td><a><?= $portfolio['portfolio_name']?></a>
                            <br>
                            <small>Created <?= $portfolio['project_date']?></small>
                         </td>

                         <td>
                           <ul class="list-inline">
                             <li class="list-inline-item">
                              <img alt="Avatar" class="table-avatar" src="../assets/img/portfolio/<?= $portfolio['project_img_1']?>">
                                </li>
                               <li class="list-inline-item">
                                   <img alt="Avatar" class="table-avatar" src="../assets/img/portfolio/<?= $portfolio['project_img_2']?>">
                                 </li>
                            </ul>
                          </td>

                           <td><?= $portfolio['client']?></td>
                           <td><?= $portfolio['project_url']?></td>
                           <td class="project-actions text-right">
                              <a class="btn btn-primary btn-sm" href="#">
                                  <i class="fas fa-folder">
                                    </i>
                                      View
                               </a>
                                <a class="btn btn-info btn-sm" href="#">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                   Edit
                                </a>
                                 <a class="btn btn-danger btn-sm" href="../include/delete/portfolio.php?id=<?= $portfolio['id']?>">
                                   <i class="fas fa-trash">
                                    </i>
                                    Delete
                                 </a>
                              </td>
                                  </tr>
                                  <?php $p++; } ?>
                              </tbody>
                          </table>
                        </div>
              <!-- pagination -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <?php
                  if($get_page_no < 1){
                    
                  }else{
                    if($get_page_no_decrement>0){
                      ?>
                        <li class="page-item"><a class="page-link" href="index.php?portfoliosetting=true&page=<?php echo $get_page_no_decrement;?>"><i class="fa-solid fa-arrow-left"></i></a></li>
                      <?php
                    }
                  }
                    for($x=1;$x<$devide_num; $x++){
                      if($x == $get_page_no){
                        ?>
                          <li class="page-item page-link bg-info"><?php echo $x;?></li>
                      <?php
                      }else{
                      ?>
                      <li class="page-item"><a class="page-link" href="index.php?portfoliosetting=true&page=<?php echo $x;?>"><?php echo $x;?></a></li>
                      <?php
                      }
                    }
                    if(!isset($_GET['page'])){
                      $get_page_no_increment = 2;
                      ?>
                    <li class="page-item"><a class="page-link" href="index.php?portfoliosetting=true&page=<?php echo $get_page_no_increment;?>"><i class="fa-solid fa-arrow-right"></i></a></li>
                    <?php
                    }else{
                      ?>
                    <li class="page-item"><a class="page-link" href="index.php?portfoliosetting=true&page=<?php echo $get_page_no_increment;?>"><i class="fa-solid fa-arrow-right"></i></a></li>
                    <?php
                    }

                    
                  ?>
                  
                </ul>
              </div>
              <!-- pagination -->
                        <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </section>
<!-- Close portfolio setting -->

<!-- Contact setting -->
        <?php
      }else if(isset($_GET['contactsetting'])){
        ?>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update Contact Setting</h3>
      </div>
              <!-- /.card-header -->
              <!-- form start -->
          <?php
            $query = "SELECT * FROM contact";
            $run = mysqli_query($db, $query);
            $contact_data = mysqli_fetch_array($run);
          ?>
      <form action="../include/admin.php" method="post">
        <div class="card-body">

         <div class="form-group">
            <label for="exampleInputEmail1">Address</label>
            <input name="address" type="text" value="<?=$contact_data['address']?>" class="form-control" id="exampleInputEmail1" placeholder="Enter your name or headline">
         </div>

         <div class="form-group">
          <label for="exampleInputPassword1">Email</label>
          <input name="email" type="email" value="<?=$contact_data['email']?>" class="form-control" id="exampleInputPassword1" placeholder="Enter your subtitle">
         </div>

       

         <div class="form-group">
          <label for="exampleCheck1" >Phone Number</label>
          <input name="call_no" type="text" value="<?=$contact_data['call']?>"  class="form-control" id="exampleCheck1">
         </div>
         </div>
                <!-- /.card-body -->

         <div class="card-footer">
           <button type="submit" name="update_contact" class="btn btn-primary">Submit</button>
         </div>
      </form>
    </div>
<!-- Close Contact setting -->

<!-- SEO setting -->
        <?php
      }else if(isset($_GET['seosetting'])){
        ?>
        <form action="../include/seo.php" method="POST" enctype="multipart/form-data">
            <div class="card-body">
            <?php
            $query = "SELECT * FROM `seo`";
            $run = mysqli_query($db, $query);
            $seo_data= mysqli_fetch_array($run);
            ?>
            <div  class="fav-img col-md-2">
              <img style="max-width:100%;" src="../assets/img/<?= $seo_data['fav_icon']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Fav-Icon</label>
                <input name="fav-icon" type="file" class="form-control" id="exampleInputEmail1">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Page Title</label>
              <input name="page_title" type="text" class="form-control" id="exampleInputPassword1" Value="<?= $seo_data['title']?>">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">All Image Alt Text</label>
              <input name="img_alt" type="text" class="form-control" id="exampleInputPassword1" value="<?= $seo_data['img_alt']?>">
            </div>
            
            <div class="form-group">
              <label for="exampleInputPassword1">Website keywords</label>
              <textarea name="keywords" rows=6 class="form-control" id="exampleInputPassword1"><?= $seo_data['keywords']?></textarea>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Page Description</label>
              <textarea rows=8 name="page_des" class="form-control" id="exampleInputPassword1"><?= $seo_data['page_des']?></textarea>
            </div>

         </div>
                    <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" name="update_seo" class="btn btn-primary">Update SEO</button>
            </div>
        </form>
<!-- Close SEO setting -->

<!-- Menu setting -->
        <?php
      }else if(isset($_GET['menusetting'])){
        ?>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Update Menu Setting</h3>
          </div>
              <!-- /.card-header -->
          <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All Menu</h3>

                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width: 10%">#</th>
                        <th style="width: 30%">Menu Name</th>
                        <th>Menu link</th>
                        <th style="width: 10%">Menu icon</th>
                        <th style="width: 15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $query_4= 'SELECT * FROM  menu';
                      $run_4 = mysqli_query($db,$query_4);
                      $c=1;
                      while($menu = mysqli_fetch_array($run_4)){
                    ?>
                    <tr>
                      <td><?= $c?></td>
                      <td><?= $menu['menu_name']?></td>
                      <td><?= $menu['menu_link']?></td>
                      <td> <?= $menu['menu_icon']?></td>
                      <td><a class="btn btn-danger p-1" href="../include/delete/menu.php?id=<?= $menu['id']?>">Delete</td>
                    </tr>  
                          <?php
                          $c++;
                        }
                      ?>
                      
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
          </div>
              <!-- form start -->
          <form action="../include/admin.php" method="post">
            <div class="card-body col-md-12">

            <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Menu Name</label>
                <input name="menu_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your Skill Name">
            </div>

            <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Menu link</label>
                <input name="menu_link" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your Skill Name">
            </div>

            <div class="form-group col-md-6">
              <label for="exampleInputPassword1">Menu Icon</label>
              <input name="menu_icon" type="text" class="form-control" id="exampleInputPassword1"">
            </div>
                    <!-- /.card-body -->

            <div class="card-footer col-md-12">
              <button type="submit" name="add_menu" class="btn btn-primary">Add Menu</button>
            </div>
          </form>
        </div>
<!-- Close Menu setting -->

<!-- Account setting -->
        <?php
      }else if(isset($_GET['accountsetting'])){
        ?>
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Update Profile</h3>
          </div>
              <!-- /.card-header -->
              <!-- form start -->
          <form action="../include/admin.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
            <?php
            $query = "SELECT * FROM `admin` WHERE 1";
            $run = mysqli_query($db, $query);
            $up_acc = mysqli_fetch_array($run);
            $pass =  crypt($up_acc['password'],"DeveloperinZamS2910!");
            ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Full name</label>
                <input name="profile_name" type="text" value="<?=$up_acc['fullname']?>" class="form-control" id="exampleInputEmail1" placeholder="Enter your name or headline">
              </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Email</label>
              <input name="profile_email" type="email" value="<?=$up_acc['email']?>" class="form-control" id="exampleInputPassword1" placeholder="Enter your subtitle">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input name="password" type="text" value="<?= $pass ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter your subtitle">
            </div>

            <div class="form-group">
              <img src="../images/<?=$up_acc['profile_photo']?>" height="100px" width="100px">
                  </br><label for="exampleInputFile">Profile Photo</label>
                    <div class="input-group">
                        <input name="profile_photo" type="file" Value="../images/<?=$up_acc['profile_photo']?>" class="form-control" id="exampleInputFile">
                    </div>
            </div>
         </div>
                    <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
            </div>
          </form>
        </div><!-- Close update profile setting -->
        <!-- Close update profile setting -->
        <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Add User Area</h3>
            </div>
          </div>
      <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-primary">
              <div class="card-header text-center">
              <a href="index.php" class="h1"><b>Add</b>USER</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>

              <form method="post" action="register.php" enctype="multipart/form-data">

                <div class="input-group mb-3">
                  <input type="text" name="fullname" class="form-control" placeholder="Full name">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <input type="email" name="user_email" class="form-control" placeholder="Email">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <input type="password" name="user_password" class="form-control" placeholder="Password">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="photo">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa-solid fa-image"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                      <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                      <label for="agreeTerms">
                      I agree to the <a href="#">terms</a>
                      </label>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-4">
                    <button type="submit" name="reg" class="btn btn-primary btn-block">Register</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>

              <div class="social-auth-links text-center">
                <a href="#" class="btn btn-block btn-primary">
                  <i class="fab fa-facebook mr-2"></i>
                  Sign up using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                  <i class="fab fa-google-plus mr-2"></i>
                  Sign up using Google+
                </a>
              </div>
            </div>
            <!-- /.form-box -->
          </div><!-- /.card -->
        </div>
        <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">User data table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>ID</th>
                      <th>User</th>
                      <th>Date</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $query_admin= 'SELECT * FROM  admin';
                  $run_admin = mysqli_query($db,$query_admin);
                  $a=1;
                  while($admin = mysqli_fetch_array($run_admin)){
                  ?>
                    <tr>
                      <td>#<?= $a?></td>
                      <td><?= $admin['id']?></td>
                      <td><?= $admin['fullname']?></td>
                      <td><?= $admin['Date']?></td>
                      <td><span class="tag tag-success"><?= $admin['email']?>l</span></td>
                      <td><a class="btn btn-danger btn-sm" href="../include/delete/user.php?id=<?= $admin['id']?>">Delete</a></td>
                    </tr>
                  <?php $a++; } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
          </div>
        </div>
      </div><!-- row close -->
      


<!-- Close Account setting -->


<!-- blogsetting -->
        <?php
      }else if(isset($_GET['postsetting'])){
        ?>
        <!-- addpost -->
        <form action="../include/post.php" method="POST" enctype="multipart/form-data">
            <div class="card-body">

            <div class="form-group">
                <label for="exampleInputEmail1">Post Title</label>
                <input name="title" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Post title">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Thambnails</label>
              <input name="thumbnail" type="file" class="form-control">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Description 1</label>
              <textarea rows=5 name="description" class="form-control" id="exampleInputPassword1">Description 1</textarea>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Video URL</label>
              <input name="video_src" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter video embad src">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Description 2</label>
              <textarea name="description_2" rows=5 class="form-control" id="exampleInputPassword1" >Description 2</textarea>
            </div>

         </div>
                    <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" name="add_post" class="btn btn-primary">Add Post</button>
            </div>
        </form>
        <div class="card">
             <div class="card-header">
               <h3 class="card-title">All Post</h3>
              
                 <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                     </button>
                     <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                      </button>
                  </div>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped projects">
                  <thead>
                    <tr>
                       <th style="width: 4%"> #</th>
                        <th style="width: 20%">Post Name</th>
                        <th style="width: 20%">Thumbnails</th>
                        <th style="width: 30%">Short Decs</th>
                        <th style="width: 25%">Action</th>
                    </tr>
                  </thead>
                    <tbody>
                      <?php   
                        // show
                        $queryp = "SELECT * FROM `post`";
                        $runp = mysqli_query($db, $queryp);
                        $num_rows = mysqli_num_rows($runp);
                        $devide_num = ($num_rows/5)+1;
                    
                        if(isset($_GET['page'])){
                        $get_page_no = $_GET['page'];
                        $offset = ($get_page_no-1)*5;
                      
                        $get_page_no_decrement = ($get_page_no-1);
                        $get_page_no_increment = ($get_page_no+1);
                      
                        }else{
                        $offset = 0;
                        $get_page_no=0;
                        }

                        $query = "SELECT * FROM `post` LIMIT 5 OFFSET $offset";
                        $run = mysqli_query($db, $query);
                        $c = 1;
                        while ($post_shows = mysqli_fetch_array($run)){
                      ?>
                      <tr>
                        <td><?= $c;?></td>
                        <td><a href="../single/post-details.php?id=<?= $post_shows['id']?>"><?= $post_shows['title']?></a><br><small>Created <?= $post_shows['date']?></small></td>
                        <td><ul class="list-inline"><li class="list-inline-item"><img alt="Avatar" class="table-avatar" src="../assets/img/post/<?= $post_shows['thumbanail']?>"></li></ul></td>
                        <td><?= $post_shows['description']?></td>
                        <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="../single/post-details.php?id=<?= $post_shows['id']?>"><i class="fas fa-folder"></i> View</a>
                          <a class="btn btn-info btn-sm"><i  class="fas fa-pencil-alt"></i> Edit</a>
                          <a class="btn btn-danger btn-sm" href="../include/delete/post.php?id=<?= $post_shows['id']?>"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                      </tr>
                    <?php $c++;} ?>
                    </tbody>
                  </table>
                </div>
                <!-- pagination -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <?php
                  if($get_page_no < 1){
                    
                  }else{
                    if($get_page_no_decrement>0){
                      ?>
                        <li class="page-item"><a class="page-link" href="index.php?postsetting&page=<?php echo $get_page_no_decrement;?>"><i class="fa-solid fa-arrow-left"></i></a></li>
                      <?php
                    }
                    
                  }
                  for($x=1;$x<$devide_num; $x++){
                    if($x == $get_page_no){
                      ?>
                        <li class="page-item page-link bg-info"><?php echo $x;?></li>
                      <?php
                    }else{
                      ?>
                      <li class="page-item"><a class="page-link" href="index.php?postsetting&page=<?php echo $x;?>"><?php echo $x;?></a></li>
                      <?php
                      }
                    }
                  
                    if(!isset($_GET['page'])){
                      $get_page_no_increment = 2;
                      ?>
                    <li class="page-item"><a class="page-link" href="index.php?postsetting&page=<?php echo $get_page_no_increment;?>"><i class="fa-solid fa-arrow-right"></i></a></li>
                    <?php
                    }else{
                      ?>
                    <li class="page-item"><a class="page-link" href="index.php?postsetting&page=<?php echo $get_page_no_increment;?>"><i class="fa-solid fa-arrow-right"></i></a></li>
                    <?php
                    }
                  ?>
                  
                </ul>
              </div>
              <!-- pagination -->
              <!-- pagination -->
                        <!-- /.card-body -->
            </div>
<!-- Close blog Control setting -->



        <?php
      }else{
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Traffic</span>
                <?php 
                  $query= "SELECT `ip_address`FROM `user_data`";
                  $result=mysqli_query($db,$query);
                  $total_visitors=mysqli_num_rows($result);
                ?>
                <span class="info-box-number">
                  <?php echo $total_visitors; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-heart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <?php
                  $query = "SELECT sum(like_count) FROM post";
                  $run = mysqli_query($db, $query);
                  $result = mysqli_fetch_array($run);
                ?>
                <span class="info-box-number"><?= $result['sum(like_count)']?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total User</span>
                <?php 
                  $query= "SELECT * FROM admin";
                  $result=mysqli_query($db,$query);
                  $total_users=mysqli_num_rows($result);
                ?>
                <span class="info-box-number"><?php echo $total_users?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1 text-white"><i class="fas fa-thumbs-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Dislike</span>
                <?php
                  $query = "SELECT sum(dislike_count) FROM post";
                  $run = mysqli_query($db, $query);
                  $result = mysqli_fetch_array($run);
                ?>
                <span class="info-box-number"><?= $result['sum(dislike_count)']?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Post Comperision</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <div id="barchart_material" style="width: 100%; height: 300px;"></div>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                 
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                      <h5 class="description-header">$35,210.43</h5>
                      <span class="description-text">TOTAL REVENUE</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">$10,390.90</h5>
                      <span class="description-text">TOTAL COST</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                      <h5 class="description-header">$24,813.53</h5>
                      <span class="description-text">TOTAL PROFIT</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Visitors Country Report</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="d-md-flex">
                  <div class="p-1 flex-fill" style="overflow: hidden">
                    <!-- Map will be created here -->
                    <div id="world-map-markers" style="height: 325px; overflow: hidden">
                      <div id="regions_div"></div>
                    </div>
                  </div>

                  <div class="card-pane-right bg-success pt-2 pb-2 pl-4 pr-4">
                    <div class="description-block mb-4">
                      <?php
                        $query = "SELECT * FROM `user_data` WHERE id=(SELECT MAX(id) FROM `user_data`)";
                        $run = mysqli_query($db, $query);
                        $result = mysqli_fetch_array($run);
                      ?>
                      <div class="sparkbar pad" data-color="#fff"><?= $result['visit_date']?></div>
                      
                      <span class="description-text">Last Visitor Time</span>
                    </div>
                    <!-- /.description-block -->
                    <div class="description-block mb-4">
                      <h5 class="description-header"><?= $result['country']?></h5>
                      <span class="description-text">Last Visitor Country</span>
                    </div>
                    <!-- /.description-block -->
                    <div class="description-block">
                      <?php
                        $query = "SELECT ip_address FROM user_data WHERE ip_address>0 ";
                        $run = mysqli_query($db, $query);
                        $organic = mysqli_num_rows($run);
                      ?>
                      <h5 class="description-header"><?php echo $organic;?></h5>
                      <span class="description-text">Total Organic</span>
                    </div>
                    <!-- /.description-block -->
                     <!-- /.description-block -->
                     <div class="description-block">
                      <?php
                        $query = "SELECT * FROM `user_data` WHERE id=(SELECT MAX(id) FROM `user_data`)";
                        $run = mysqli_query($db, $query);
                        $result = mysqli_fetch_array($run);
                      ?>
                      <h5 class="description-header"><?= $result['ip_address']?></h5>
                      <span class="description-text">Last Visitor Ip</span>
                    </div>
                    <!-- /.description-block -->
                  </div><!-- /.card-pane-right -->
                </div><!-- /.d-md-flex -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
              <div class="col-md-6">
                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-warning">
                  <div class="card-header">
                    <h3 class="card-title">Contact</h3>

                    <div class="card-tools">
                      <?php
                          $query ="SELECT * FROM `contact_from`";
                          $run = mysqli_query($db, $query);
                          $total_contact = mysqli_num_rows($run);
                      ?>
                      <span title="3 New Messages" class="badge badge-warning"><?php echo $total_contact;?> Total Contact</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                        <i class="fas fa-comments"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                      <!-- Message. Default to the left -->
                      <?php
                      if(isset($_GET['contact_id'])){
                        $chat_id = $_GET['contact_id'];
                        $query ="SELECT * FROM `contact_from` WHERE id=$chat_id";
                        $run = mysqli_query($db, $query);
                        $contact_details_show = mysqli_fetch_array($run);
                      }else{
                        $chat_id = 1;
                        $query ="SELECT * FROM `contact_from` WHERE id=$chat_id";
                        $run = mysqli_query($db, $query);
                        $contact_details_show = mysqli_fetch_array($run);
                      } 
                      ?>
                      <div class="direct-chat-msg" id="contact_id=<?= $contact_details_show['id']?>">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left"><?= $contact_details_show['name']?></span>
                          <span class="direct-chat-timestamp float-right"><?= $contact_details_show['date']?></span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                        <?= $contact_details_show['message']?>
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->

                      <!-- Message to the right -->
                      <!-- <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-right">Sarah Bullock</span>
                          <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                        </div> -->
                        <!-- /.direct-chat-infos -->
                        <!-- <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image"> -->
                        <!-- /.direct-chat-img -->
                        <!-- <div class="direct-chat-text">
                          You better believe it!
                        </div> -->
                      <!-- </div> -->
                      <!-- /.direct-chat-msg -->

                      

                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts" id="index.php?all_contact">
                      <ul class="contacts-list">
                        <?php
                         $query ="SELECT * FROM `contact_from`";
                         $run = mysqli_query($db, $query);
                         while ($contact_show = mysqli_fetch_array($run)){;
                         ?>
                        <li>
                          <a href="index.php?contact_id=<?= $contact_show['id']?>">
                            <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Avatar">

                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                <?= $contact_show ['email']?>
                                <small class="contacts-list-date float-right"><?= $contact_show ['date']?></small>
                              </span>
                              <span class="contacts-list-msg"><?= $contact_show ['subject']?></span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <?php } ?>
                        <!-- End Contact Item -->

                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                      </ul>
                      <!-- /.contacts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <form action="send_mail.php" method="post">
                      <div class="input-group">
                        
                          <input type="hidden" name="chat_id" value="<?php echo $chat_id; ?>">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-append">
                          <button name="send_mail" type="submit" class="btn btn-warning">Send</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
              </div>
              <!-- /.col -->

              <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Latest Members</h3>

                    <div class="card-tools">
                    <?php
                        $query_users = "SELECT * FROM admin";
                        $run_users = mysqli_query($db,$query_users);
                        $t_user = mysqli_num_rows($run_users);
                      ?>
                      <span class="badge badge-danger"><?= $t_user ?> Members</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      <?php
                        $query_user = "SELECT * FROM admin LIMIT 8";
                        $run_user = mysqli_query($db,$query_user);
                        while($admin = mysqli_fetch_array($run_user) ){
                      ?>
                      <li>
                        <img src="../images/<?= $admin["profile_photo"]?>" alt="User Image">
                        <a class="users-list-name" href="#"><?= $admin['fullname']?></a>
                        <span class="users-list-date"><?= $admin['Date']?></span>
                      </li>
                      <?php } ?>
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="index.php?accountsetting=true">View All Users</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card hei">
              <div class="card-header border-transparent">
                <h3 class="card-title">Subscriber</h3>

                <div class="card-tools">
                <?php
                $query = "SELECT * FROM `subscribe`";
                $subscribers = mysqli_query($db, $query);
                $total_subscriber = mysqli_num_rows($subscribers);
                ?>
                  <span class="badge badge-success"><?php echo $total_subscriber;?>Total subscriber</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      // pagination
                      $sql1 = "SELECT * FROM  subscribe";
                      $run_sql1 = mysqli_query($db,$sql1);
                      $num_rows = mysqli_num_rows($run_sql1);
                    
                      $devide_num = ($num_rows/5)+1;
                    
                      if(isset($_GET['page'])){
                      $get_page_no = $_GET['page'];
                      $offset = ($get_page_no-1)*5;
                    
                      $get_page_no_decrement = ($get_page_no-1);
                      $get_page_no_increment = ($get_page_no+1);
                    
                      }else{
                      $offset = 0;
                      $get_page_no=0;
                      }

                    // show
                    $query = "SELECT * FROM `subscribe` LIMIT 7 OFFSET $offset";
                    $run = mysqli_query($db, $query);
                    $s = 1;
                    while ($subscriber = mysqli_fetch_array($run)) {
                    ?>
                    <tr>
                      <td><?php echo $s ?></td>
                      <td><?= $subscriber['email']?></td>
                      <td><a class="btn btn-danger p-1" href="../include/delete/subscriber.php?id=<?= $subscriber['id']?>"><span class="badge badge-danger">Delete</span></a></td>
                    </tr>
                    <?php $s++; } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->

               <!-- pagination -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <?php
                  if($get_page_no < 1){
                    
                  }else{
                    if($get_page_no_decrement>0){
                      ?>
                        <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $get_page_no_decrement;?>"><i class="fa-solid fa-arrow-left"></i></a></li>
                      <?php
                    }
                    
                  }
                  for($x=1;$x<$devide_num; $x++){
                    if($x == $get_page_no){
                      ?>
                        <li class="page-item page-link bg-info"><?php echo $x;?></li>
                      <?php
                    }else{
                      ?>
                      <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $x;?>"><?php echo $x;?></a></li>
                      <?php
                      }
                    }
                  
                    if(!isset($_GET['page'])){
                      $get_page_no_increment = 2;
                      ?>
                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $get_page_no_increment;?>"><i class="fa-solid fa-arrow-right"></i></a></li>
                    <?php
                    }else{
                      ?>
                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $get_page_no_increment;?>"><i class="fa-solid fa-arrow-right"></i></a></li>
                    <?php
                    }
                  ?>
                  
                </ul>
              </div>
              <!-- pagination -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Post</span>
                <?php
                $query = "SELECT * FROM `post`";
                $run = mysqli_query($db, $query);
                $total_post = mysqli_num_rows($run);
                ?>
                <span class="info-box-number"><?php echo $total_post; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="far fa-heart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Mentions</span>
                <span class="info-box-number">92,050</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Downloads</span>
                <span class="info-box-number">114,381</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="far fa-comment"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Direct Contact</span>
                <?php
                  $query = "SELECT * FROM `contact_from`";
                  $run = mysqli_query($db, $query);
                  $total_contact= mysqli_num_rows($run);
                ?>
                <span class="info-box-number"><?php echo $total_contact; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Browser Usage</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="chart-responsive">
                      <!-- <canvas id="pieChart" height="150"></canvas> -->
                      <div id="piechart_3d" style="width: 100%; height: 201px;"></div>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->

                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                    <span id="active-users-count">0</span> active users


                      <span class="float-right text-danger">
                        <i class="fas fa-arrow-down text-sm"></i>
                        12%</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      India
                      <span class="float-right text-success">
                        <i class="fas fa-arrow-up text-sm"></i> 4%
                      </span>
                    </a>
                  </li>

                </ul>
              </div>
              <!-- /.footer -->
            </div>
            <!-- /.card -->

            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added Post</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php
                $query = "SELECT * FROM `post` ORDER BY id DESC LIMIT 4";
                $run = mysqli_query($db, $query);
                while ($show_posts = mysqli_fetch_array($run)){
                ?>
                <li class="item">
                    <div class="product-img">
                      <img src="../assets/img/post/<?= $show_posts['thumbanail']; ?>" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title"><?= $show_posts['title']; ?>
                        <span class="badge badge-info float-right"><?= $show_posts['like_count']; ?></span>
                        <span class="badge badge-warning float-right"> <?= $show_posts['dislike_count']; ?></span>
                      </a>
                      <span class="product-description"><?= $show_posts['title']; ?></span>
                    </div>
                  </li>
                  <?php } ?>
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="index.php?postsetting" class="uppercase">View All Post</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>

    <!-- /.content -->
  <?php }?>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

 
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-<?php echo $hello= date("Y")?> <a href="https://inzams.com">Developer InZam'<span style="color: red; font-weight:900;">S</span></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->



<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- REQUIRED SCRIPTS -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      <?php 
         // Opera
        $query= "SELECT * FROM user_data WHERE browser= 'O'";
        $result=mysqli_query($db,$query);
        $total_opera=mysqli_num_rows($result);
        $opera_user = mysqli_fetch_assoc($result);
          echo "['".'Opera'."', ".$total_opera." ],";
       
        // Mozilla/5.
        $query2= "SELECT * FROM user_data WHERE browser= 'F'";
        $result2=mysqli_query($db,$query2);
        $total_firefox =mysqli_num_rows($result2);
        $firefox_user = mysqli_fetch_assoc($result2);
        echo "['".'Firefox'."', ".$total_firefox." ],";

        // Chrome
        $query3= "SELECT * FROM user_data WHERE browser= 'C'";
        $result3=mysqli_query($db,$query3);
        $total_chrome =mysqli_num_rows($result3);
        $chrome_user = mysqli_fetch_assoc($result3);
        echo "['".'Chrome'."', ".$total_chrome." ],";

        // microsoft edge
        $queryEdge= "SELECT * FROM user_data WHERE browser= 'M'";
        $resultEdge=mysqli_query($db,$queryEdge);
        $total_Edge =mysqli_num_rows($resultEdge);
        $Edge_user = mysqli_fetch_assoc($resultEdge);
        echo "['".'Microsoft Edge'."', ".$total_Edge." ],";

        // Internet Explorer
        $queryExplorer= "SELECT * FROM user_data WHERE browser= 'I'";
        $resultExplorer=mysqli_query($db,$queryExplorer);
        $total_Explorer =mysqli_num_rows($resultExplorer);
        $Explorer_user = mysqli_fetch_assoc($resultExplorer);
        echo "['".'Internet Explorer'."', ".$total_Explorer." ],";

        // Safari
        $querySafari= "SELECT * FROM user_data WHERE browser= 's'";
        $resultSafari=mysqli_query($db,$querySafari);
        $total_Safari =mysqli_num_rows($resultSafari);
        $Safari_user = mysqli_fetch_assoc($resultSafari);
        echo "['".'Safari'."', ".$total_Safari." ],";

        // Safari
        $queryU= "SELECT * FROM user_data WHERE browser= 'U'";
        $resultU=mysqli_query($db,$queryU);
        $total_U =mysqli_num_rows($resultU);
        $U_user = mysqli_fetch_assoc($resultU);
        echo "['".'Unidetified'."', ".$total_U." ],";

      ?>
    ]);

    var options = {
      title: 'Daily Activities',
      is3D: true,
      backgroundColor : '#DEDFE0',
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
  }
</script>

<!-- country -->
<script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'VIsitors'],
          <?php 
            // Bangladesh
            $query= "SELECT * FROM user_data WHERE country = 'Bangladesh'";
            $result=mysqli_query($db,$query);
            $total_Ban =mysqli_num_rows($result);
            echo "['".'Bangladesh'."', ".$total_Ban." ],";

            // Russia
            $queryRussia= "SELECT * FROM user_data WHERE country = 'Russia'";
            $resultRussia=mysqli_query($db,$queryRussia);
            $total_Russia =mysqli_num_rows($resultRussia);
            echo "['".'Russia'."', ".$total_Russia." ],";

            // France
            $queryFrance= "SELECT * FROM user_data WHERE country = 'France'";
            $resultFrance=mysqli_query($db,$queryFrance);
            $total_France =mysqli_num_rows($resultFrance);
            echo "['".'France'."', ".$total_France." ],";

            // India
            $queryIndia = "SELECT * FROM user_data WHERE country = 'India'";
            $resultIndia=mysqli_query($db,$queryIndia);
            $total_India =mysqli_num_rows($resultIndia);
            echo "['".'India'."', ".$total_India." ],";
            
            // United Sta
            $queryUnited= "SELECT * FROM user_data WHERE country = 'United Sta'";
            $resultUnited=mysqli_query($db,$queryUnited);
            $total_United =mysqli_num_rows($resultUnited);
            echo "['".'United States'."', ".$total_United." ],";
            
            // China
             $China= "SELECT * FROM user_data WHERE country = 'China'";
            $result_China=mysqli_query($db,$China);
            $total_China =mysqli_num_rows($result_China);
            echo "['".'China'."', ".$total_China." ],";
            
            // Belgium
            $Belgium= "SELECT * FROM user_data WHERE country = 'Belgium'";
            $result_Belgium=mysqli_query($db,$Belgium);
            $total_Belgium =mysqli_num_rows($result_Belgium);
            echo "['".'Belgium'."', ".$total_Belgium." ],";
            
            // Ireland
            $Ireland= "SELECT * FROM user_data WHERE country = 'Ireland'";
            $result_Ireland=mysqli_query($db,$Ireland);
            $total_Ireland =mysqli_num_rows($result_Ireland);
            echo "['".'Ireland'."', ".$total_Ireland." ],";
            
            // Germany
            $Germany= "SELECT * FROM user_data WHERE country = 'Germany'";
            $result_Germany=mysqli_query($db,$Germany);
            $total_Germany =mysqli_num_rows($result_Germany);
            echo "['".'Germany'."', ".$total_Germany." ],";
            
            


          ?>
        ]);

        var options = {
          backgroundColor : '#343A40',
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
</script>
<!-- post like dislike counter counter -->

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Post Id', 'Like', 'Dislike'],
          <?php
          $query = "SELECT * FROM `post`";
          $run = mysqli_query($db, $query);
          while($posts = mysqli_fetch_array($run)){
            ?>
          ['<?php echo $posts['id']; ?>', <?php echo $posts['like_count']; ?>, <?php echo $posts['dislike_count']; ?>],

          <?php } ?>
        ]);

        var options = {
          title: 'Post Like Dislike Graph',
          curveType: 'function',
          legend: { position: 'bottom' },
          backgroundColor: 'white',
        };

        var chart = new google.visualization.LineChart(document.getElementById('barchart_material'));

        chart.draw(data, options);
      }
    </script>
</body>
</html>