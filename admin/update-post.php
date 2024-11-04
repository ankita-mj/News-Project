<?php

include "header.php"; 
include "config.php";
if(isset($_GET['id'])){
echo $pid = $_GET['id'];
}
if(isset($_POST['submit'])){
     $error = array();
      

      $file_name = $_FILES['new-image']['name'];
      $file_temp = $_FILES['new-image']['tmp_name'];
      $file_size = $_FILES['new-image']['size'];
      $file_type = $_FILES['new-image']['type'];
      $file_ext = strtolower(end(explode('.',$file_name)));
      $ext = ['jpeg','jpg','jfif','png'];
      if(in_array($file_ext,$ext) === false){
         $error[] = "this extension file is not allowed please upload jpeg, jpg, png, jfif..";
      }
      if($file_size > 2097152){
         $error[] = "file must be 2mb or less than..";
        }
      if(empty($error)){
        move_uploaded_file($file_temp,"upload/".$file_name);

        $post_id = $_POST['post_id'];
        $post_title = $_POST['post_title'];
        $post_desc = $_POST['post_desc'];
        $post_cat = $_POST['category'];
        $p_img = $_FILES['new-image']['name'];
        $sql1 = "UPDATE post SET post_title = '{$post_title}', post_description = '{$post_desc}', post_img = '{$p_img}', category = {$post_cat} WHERE post_id = {$post_id};";
        if(mysqli_query($conn,$sql1)){
          header("location: {$host}/admin/post.php");
        }else{
          echo "query faile";
        }
        
        
      }else{
        echo "<pre>";
        print_r($error);
        echo "</pre>";
      }
      
      
      
    }
    ?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <?php
           echo $sql = "SELECT * FROM post WHERE post_id = {$pid}";
           $result = mysqli_query($conn,$sql);
           if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
        ?>

        <form action="<?= $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id']?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['post_title']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="post_desc" class="form-control"  required rows="5">
                    <?php echo $row['post_description']?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                <?php
                   $sql1 = "select * from category";
                   $result1 = mysqli_query($conn,$sql1);
                   while($row1 = mysqli_fetch_assoc($result1)){
                    if($row1['category_id'] == $row['category']){
                       $select = 'selected';
                    }else{
                       $select = '';
                    }
                     echo"<option {$select} value='$row1[category_id]'> {$row1['category_name']} </option>";
                   }
                ?>
                

                    
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image" value="upload/<?php echo $row['post_img']?>">
                <?php
                if(isset($_FILES['new-image']['name'])){
                    echo "<img  src='upload/{$row['post_img']}' height='150px'>";
                }else{
                    echo "<img src='upload/{$row['post_img']}' height='150px'>";

                }
                ?>
                <input type="hidden" name="old-image" value="">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php
           }else{
            echo "result not found";
           } 
        ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
