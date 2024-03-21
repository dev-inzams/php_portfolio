<?php
require('../include/db.php');
    if(isset($_POST['send_mail'])){
        $message = $_POST['message'];
        $chat_id = $_POST['chat_id'];
        
        $query = "SELECT email FROM contact_from WHERE id= $chat_id";
        $run = mysqli_query($db, $query);
        $result = mysqli_fetch_array($run);
        $reciver_email = $result['email'];
        
    //   php mailler
    $to = "$reciver_email";
    $subject = "Reply by Developer inZamS";

    $message = "<p>$message</p>";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <no-replay@inzams.com>' . "\r\n";
    $headers .= 'Cc: no-replay@inzams.com' . "\r\n";

    // mail($to,$subject,$message,$headers);
    if(mail($to,$subject,$message,$headers)){
    echo "<script>window.location.href = 'index.php' </script>";
    }
        
    }

?>