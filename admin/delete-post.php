<?php
   include "header.php";
   include "config.php";
   $pid = $_GET['pid'];
   $cid = $_GET['cid'];
   $sql1 = "SELECT * FROM post WHERE post_id = {$pid}";
   $result = mysqli_query($conn,$sql1);
   $row = mysqli_fetch_assoc($result);
   unlink("upload/{$row['post_img']}");


   $sql = "DELETE FROM post WHERE post_id = {$pid};";
   $sql .="UPDATE category SET post = post - 1 WHERE category_id = {$cid}";
   if(mysqli_multi_query($conn,$sql)){
     header("location: http://localhost/news-site/admin/post.php");
   }else{
     echo "<div class='alert alert-danger'> Query Failed </div>";
   }
?>