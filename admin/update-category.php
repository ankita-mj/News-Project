<?php 
     include "header.php"; 
     include "config.php";
     $id = $_GET['id'];
 
     if(isset($_POST['set'])){
        $cat_name = mysqli_real_escape_string($conn,$_POST['cat_name']);
        $car_id = $_POST['cat_id'];
        $sql1="UPDATE category SET category_name = '{$cat_name}' WHERE category_id = {$car_id}";
        if(mysqli_query($conn,$sql1)){
           header("location: {$host}/admin/category.php");
        }else{
           echo "<div class= 'alert alert-danger'> query failed </div>";
        }

     }
     

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?= $_SERVER['PHP_SELF']?>" method ="POST">
                  <?php
                      
                      echo $sql = "SELECT * FROM category WHERE category_id = $id";
                     $result = mysqli_query($conn,$sql);
                     if(mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_assoc($result);
                  ?>
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?= $row['category_id']?>" >
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?= $row['category_name']?>" required>
                      </div>
                      <input type="submit" name="set" class="btn btn-primary" value="Update" required />
                      <?php
                        }
                        ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php 
    include "footer.php";  
?>
