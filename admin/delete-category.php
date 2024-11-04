<?php
  include "config.php";
  $id = $_GET['id'];
  echo $sql = "DELETE FROM category WHERE category_id = {$id};";
  $sql .= "DELETE FROM post where category_id = {$id}";
  $result = mysqli_multi_query($conn,$sql); 
  header("location: http://localhost/news-site/admin/category.php");
?>