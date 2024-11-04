<?php 
    include "header.php"; 
    include "config.php";
    if($_SESSION['role']=='0'){
      header("location: {$host}/admin/post.php");  
  }

 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                <?php
               
                if(isset($_GET['i'])){
                  $page = $_GET['i'];
                }else{
                  $page = 1;
                }
                $limit = 3;
                $offset = ($limit * $page) - $limit;

                    $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit};";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                          while($row = mysqli_fetch_assoc($result)){
                        ?>
                          <tr>
                              <td class='id'><?php echo $row['user_id']?></td>
                              <td><?php echo $row['f_name']." ".$row['l_name']?></td>
                              <td><?php echo $row['u_name']?></td>
                              <td>
                                <?php
                                      if($row['role']==1){
                                           echo "admin";
                                      }else{
                                           echo "normal"; 
                                      }
                                ?>
                              </td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id']?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php 
                        }
                        ?>
                      </tbody>
                  </table>
                  <?php
                     }
                  ?>
            <?php
               $sql1 = "select * from user";
               $result1 = mysqli_query($conn,$sql1);
               if(mysqli_num_rows($result1) > 0){
               $totalrows = mysqli_num_rows($result1);

               $noofpage = ceil($totalrows/$limit); 

               echo "<ul class='pagination admin-pagination'>";
              if($page > 1){
                 echo '<li><a href = "users.php?i='.($page-1).'">prev</a></li>';
              }

              for($i=1; $i <= $noofpage; $i++){
                if($i == $page){
                  $active = "active";
                }else{
                  $active = "";
                  
                }
                echo "<li class= '$active'><a href='users.php?i=$i'> $i </a></li>";  
              }
              if($page < $noofpage){
                echo "<li><a href = 'users.php?i=".($page+1)."' >next</a></li>";

              }
              echo "</ul>";
              }

            ?>
                  
                      
                     
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
