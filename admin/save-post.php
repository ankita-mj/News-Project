<?php
if(isset($_FILES['fileToUpload'])){
    session_start();


    $error = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_temp = $_FILES['fileToUpload']['tmp_name'];
    $file_ext = end(explode('.',$file_name));
    $ext = ['jpeg','jpg','png','jfif'];
    if(in_array($file_ext,$ext) === false){
         $error[] = "this extension file is not allowed please upload jpeg, jpg, png.";
    }
    if($file_size > 2097152){  //less then 2mb
       $error[] = "file must be 2mb or less than.";
    }
    if(empty($error) === true){
         move_uploaded_file($file_temp,"upload/".$file_name);
         $conn = mysqli_connect("localhost","root","padduu","news",3307);
         $post_title = mysqli_real_escape_string($conn,$_POST['post_title']);
         $postdesc = mysqli_real_escape_string($conn,$_POST['postdesc']);
         $category = mysqli_real_escape_string($conn,$_POST['category']);//category_id
         $date = date("Y-m-d");
         
         $author = $_SESSION['user_id'];
         $sql = "INSERT INTO post(post_title, post_description, post_date, post_img, category, author) VALUES 
                ('{$post_title}','{$postdesc}','{$date}','{$file_name}','{$category}','{$author}');";
         $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category};";
     
         if(mysqli_multi_query($conn, $sql)){
             header("location: http://localhost/news-site/admin/post.php");
         }else{
             echo "<div class='alert alert-danger'>query failed</div>";
         }
    }else{
        print_r($error);
    }



}
?>