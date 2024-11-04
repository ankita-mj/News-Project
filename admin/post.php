<?php
   include "header.php"; //session_start();
   include "config.php";
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                    <?php
                    $limit = 3;
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }
                    $offset = ($page-1)*$limit;
                    if($_SESSION['role'] == '1'){

                        $sql = "SELECT * FROM post,user,category WHERE post.category = category.category_id AND post.author = user.user_id ORDER BY post_id DESC LIMIT {$offset},{$limit};";
                    
                    }else if($_SESSION['role'] == '0'){

                         $sql = "SELECT * FROM post,user,category WHERE post.category = category.category_id AND post.author = user.user_id AND user_id = {$_SESSION['user_id']} ORDER BY post_id DESC LIMIT {$offset},{$limit};";
                    
                    }

                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                      
                    ?>
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                      while($row = mysqli_fetch_assoc($result)){
                        ?>
                          <tr>
                              <td class='id'><?php echo $row['post_id']?></td>
                              <td><?php echo $row['post_title']?></td>
                              <td><?php echo $row['category_name']?></td>
                              <td><?php echo $row['post_date']?></td>
                              <td><?php echo $row['f_name']." ".$row['l_name']?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id'];?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?pid=<?php echo $row['post_id'];?>&cid=<?php echo $row['category'];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                      </tbody>
                      <?php
                      }}
                      ?>
                  </table>
                  <?php
                    if($_SESSION['role'] == 1){
                       $sql1 = "SELECT * FROM post";
                    }else if($_SESSION['role'] == 0){
                        $sql1 = "SELECT * FROM post,user WHERE post.author = user.user_id AND user_id = {$_SESSION['user_id']}";
                    }

                    $result1 = mysqli_query($conn,$sql1);
                    $totalrow = mysqli_num_rows($result1);
                    $totalpage = ceil($totalrow/$limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if($page > 1){
                        echo "<li><a href='post.php?page=".($page-1)."'> pre </a></li>"; 
 
                     }
                     for($i=1; $i<=$totalpage; $i++){
                        if($page == $i){
                           $active = 'active';
                        }else{
                            $active = '';

                        }
                           echo "<li class = {$active}><a href='post.php?page={$i}'> $i </a></li>";
                     }
                  if($page < $totalpage){
                      echo "<li><a href='post.php?page=".($page+1)."'> next </a></li>";
                  }
                      
                  echo "</ul>";
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
