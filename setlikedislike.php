<?php
  require('include/db.php');

    if(isset($_POST['type']) && $_POST['type']!='' && isset($_POST['id']) && $_POST['id']>0){
      $type = mysqli_real_escape_string($db,$_POST['type']);
      $id = mysqli_real_escape_string($db,$_POST['id']);

      if($type=='like'){
        if(isset($_COOKIE['like_'.$id])){
          setcookie('like_'.$id,"yes",1);
          $query = "UPDATE post SET like_count=like_count-1 WHERE id='$id'";
          $operation = "unlike";
        }else{
          if(isset($_COOKIE['dislike_'.$id])){
            setcookie('dislike_'.$id,"yes",1);
            mysqli_query($db, "UPDATE post SET dislike_count=dislike_count-1 WHERE id='$id'");
          }

          setcookie('like_'.$id,"yes",time()+60*60*24*365*5);
          $query = "UPDATE post SET like_count=like_count+1 WHERE id='$id'";
          $operation = "like";
        }
        
      }
      if($type=='dislike'){
        if(isset($_COOKIE['dislike_'.$id])){
          setcookie('dislike_'.$id,"yes",1);
          $query = "UPDATE post SET dislike_count=dislike_count-1 WHERE id='$id'";
          $operation = "undislike";
        }
        else{
          if(isset($_COOKIE['like_'.$id])){
            setcookie('like_'.$id."yes",1);
            mysqli_query($dn,"UPDATE post SET like_count=like_count-1 WHERE id='$id'");
          }
          setcookie('dislike_'.$id,"yes",time()+60*60*24*365*5);
          $query = "UPDATE post SET dislike_count=dislike_count+1 WHERE id='$id'";
          $operation = "dislike";
        }

      }
      mysqli_query($db, $query);

      $query00 = mysqli_query($db, "SELECT * FROM `post` WHERE id='$id'");
      $row = mysqli_fetch_array($query00);
      echo json_encode([
        'operation'=> $operation, 
        'like_count'=>$row['like_count'], 
        'dislike_count'=> $row['dislike_count']
      ]);
    }
?>