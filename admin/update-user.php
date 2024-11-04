<?php 
   include "header.php"; 
   include "config.php";
   $u_id = $_GET['id'];
   if(isset($_POST['submit'])){
    
     $f_name = mysqli_real_escape_string($conn,$_POST['f_name']);
     $l_name = mysqli_real_escape_string($conn,$_POST['l_name']);
     $u_name = mysqli_real_escape_string($conn,$_POST['username']);
     $role = mysqli_real_escape_string($conn,$_POST['role']);
      
     $sql = "SELECT u_name FROM user WHERE u_name = '{$u_name}' AND user_id <> '{$u_id}'";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result)>0){
        echo "<p style = 'color:red; tex-align:center;'>username already exist<p>";

     }else{
        $sql1 = "UPDATE user set f_name = '{$f_name}', l_name = '{$l_name}', u_name = '{$u_name}', role = '{$role}' where user_id = '{$u_id}'";
        mysqli_query($conn,$sql1);
       header("location: {$host}/admin/users.php");
        
     }

   }
  
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']?>" method ="POST">
                    <?php
                      $sql = "SELECT * FROM user WHERE user_id = $u_id"; 
                      $result = mysqli_query($conn,$sql);
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['f_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['l_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['u_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role">
                            <?php
                            if($row['role'] == 1){
                              echo "<option  value='0'> normal User </option>";
                              echo "<option selected value='1'> Admin </option>";
                            }else{
                              echo "<option selected value='0'> normal User </option>";
                              echo "<option  value='1'> Admin </option>";
                            }
                            ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                      <?php }} ?>
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
