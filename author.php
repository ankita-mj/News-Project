<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    $u_id = $_GET['author_id'];

                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                     }else{
                       $page = 1;
                     }
                     $limit = 3; 
                     $offset = ($page-1)*$limit;
                     

                    $sql = "SELECT * FROM post INNER JOIN user ON post.author = user.user_id INNER JOIN category ON post.category = category.category_id AND post.author = {$u_id} ORDER BY post_id LIMIT {$offset},{$limit}";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "<h2 class='page-heading'>{$row['f_name']}"." "."{$row['l_name']}</h2>";
                    
                    
                    // $sql1 = "SELECT * FROM post INNER JOIN user ON post.author = user.user_id INNER JOIN category ON post.category = category.category_id AND post.author = {$u_id}";

                    $result1 = mysqli_query($conn,$sql);
                    while($row1 = mysqli_fetch_assoc($result1)){
                    ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id']?>"><img src="admin/upload/<?= $row1['post_img']?>" alt="img not found"/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row1['post_id']?>'><?php echo $row1['post_title']?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?c_id=<?php echo $row1['category_id']?>'><?php echo $row1['category_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?author_id=<?php echo $row1['user_id'] ?>'><?php echo $row1['f_name']." ".$row['l_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row1['post_date']?>
                                        </span>
                                    </div>
                                    <p class="description">
                                        <?php echo $row1['post_description']?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row1['post_id']?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } 
                    
                    $sql2 = "SELECT * FROM post WHERE author = $u_id;";
                    $result2 = mysqli_query($conn,$sql2);
                     $totalrow = mysqli_num_rows($result2);
                     $totalpage = ceil($totalrow / $limit);
                    echo "<ul class='pagination'>";
                    if($page > 1){
                      echo "<li><a href='category.php?page=".($page- 1)."'>pre</a></li>";
                    }
                    for($i = 1; $i <= $totalpage; $i++){
                       if($i == $page){
                          $active = "active";
                       }else{
                          $active = "";
                       }
                      echo "<li class='{$active}' ><a href='author.php?page=$i&u_id=$u_id'>$i</a></li>";
                    }
                    if($page < $totalpage){
                      echo "<li><a href='category.php?page=".((int)$page+1)."'>next</a></li>";


                    } 
?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
