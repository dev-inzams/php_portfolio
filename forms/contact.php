<?php
  require('../include/db.php');


  if(isset($_POST['send_message'])){
    $name = mysqli_real_escape_string($db,$_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $subject = mysqli_real_escape_string($db, $_POST['subject']);
    $message =mysqli_real_escape_string($db, $_POST['message']);
    
    
    //   php mailler
    $to = "inzams.hp@gmail.com, $email";
    $subject = "$subject";

    $message = "<p>$message</p>";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <no-replay@inzams.com>' . "\r\n";
    $headers .= 'Cc: no-replay@inzams.com' . "\r\n";

    mail($to,$subject,$message,$headers);
    // end mail

    $query = "INSERT INTO `contact_from`(`name`, `email`, `subject`, `message`) VALUES ('$name','$email','$subject','$message')";
    $run = mysqli_query($db, $query);

    $text="";

    if($run){
      $text="Seed Message Done";
      echo "<script>window.location.href = '../index.php?#contact' </script>";
    }
  }
?>
