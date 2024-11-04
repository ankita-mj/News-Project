<?php 
include 'config.php';
$u_id = $_GET['id'];
$sql = "delete from user where user_id = $u_id";
mysqli_query($conn,$sql);
header("location: {$host}/admin/users.php");
?>