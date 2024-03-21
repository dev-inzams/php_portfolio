<?php
require('../include/db.php');
$ids = $_GET['id'];
$query= "SELECT * FROM post WHERE id=$ids";
$run = mysqli_query($db,$query);
$user_data = mysqli_fetch_array($run);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $user_data['title']?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <style>

  </style>

</head>

<body>

  <main id="main">

    <!-- ======= Portfolio Details ======= -->
    <div id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row">

          <div class="col-lg-8">
            <h2 class="portfolio-title"><?= $user_data['title']?></h2>
                     <!--google ads-->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5841976484236137"
     crossorigin="anonymous"></script>
<!-- horaijontal blogs page ads -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5841976484236137"
     data-ad-slot="8763296000"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<!--colose google ads-->

            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper0 align-items-center c_img">
                <?php
                $query = "SELECT * FROM `seo`";
                $run = mysqli_query($db, $query);
                $alt = mysqli_fetch_array($run);
                ?>

                  <img src="../assets/img/post/<?= $user_data['thumbanail']?>" alt="<?= $alt['img_alt']?>">

                  <div class="des">
                    <p><?= $user_data['description']?></p>
                  </div>
                
                  <iframe width="100%" height="391" src="<?= $user_data['image_1']?>" title="<?= $user_data['title']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                  <div class="des">
                    <p><?= $user_data['description_2']?></p>
                  </div>
                  <hr>
                  <div class="des">
                    <p>Thanks for reading the blog, Hope the blog will be useful for you.</p>
                      <div class="info-box">
                        <i class="bx bx-share-alt"></i>
                        <h3>Social Profiles</h3>
                        <?php
                        $query = "SELECT * FROM `social_media` WHERE 1";
                        $run = mysqli_query($db, $query);
                        $s_link = mysqli_fetch_array($run);
                        ?>
                            <div class="social-links">
                              <a href="https://twitter.com/<?= $s_link['twitter'];?>" class="twitter mr-2"><i class="bi bi-twitter"></i></a>
                              <a href="https://facebook.com/<?= $s_link['facebook'];?>" class="facebook mr-2"><i class="bi bi-facebook"></i></a>
                              <a href="https://instagram.com/<?= $s_link['instagrame'];?>" class="instagram mr-2"><i class="bi bi-instagram"></i></a>
                              <a href="https://youtube.com/<?= $s_link['youtube'];?>" class="youtube mr-2"><i class="bi bi-youtube"></i></a>
                            </div>
                      </div>
                  </div>

              </div>
              
            </div>

          </div>

          <div class="col-lg-4 portfolio-info">
            <h3>Blog information</h3>
            <ul>
              <li><strong>Category</strong>: Web Development</li>
              <li><strong>Published date</strong>: <?= $user_data['date']?></li>
            </ul> 
          </div>
        </div>
      </div>
    </div><!-- End Portfolio Details -->

  </main><!-- End #main -->

  <div class="credits">
    Designed by <a href="https://inzams.com/">Developer InZam'<span style="color:red;">S</span></a>
  </div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  
</body>

</html>