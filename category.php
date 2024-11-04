<?php
  include 'header.php';
  include 'config.php';
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    $c_id = $_GET['c_id'];
                    $sql1 = "SELECT * FROM category WHERE category_id = $c_id";
                    $result1 = mysqli_query($conn,$sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    ?>
                    <h2 class="page-heading"><?php echo $row1['category_name']?></h2>

                    <?php
                     if(isset($_GET['page'])){
                        $page = $_GET['page'];
                     }else{
                       $page = 1;
                     }
                     $limit = 3; 
                     $offset = ($page-1)*$limit;
                     $sql = "SELECT * FROM post,category,user WHERE post.category = category.category_id AND post.author = user.user_id  AND category.category_id = $c_id ORDER BY post_id DESC LIMIT {$offset},{$limit}";
                     $result = mysqli_query($conn,$sql);
                     while($row = mysqli_fetch_assoc($result)){
                    
                    ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?= $row['post_id']?>"><img src="admin/upload/<?php echo $row['post_img']?>" alt="not displayed"/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?= $row['post_id']?>'><?php echo $row['post_title']?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?c_id=<?php echo $row['category_id']?>'><?php echo $row['category_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?author_id=<?php echo $row['user_id']?>'><?php echo $row['f_name']." ".$row['l_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']?>
                                        </span>
                                    </div>
                                    <p class="description">
                                        <?php echo substr($row['post_description'],0,150)?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?= $row['post_id']?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } 
                    
                    $sql2 = "SELECT * FROM post WHERE category = $c_id;";
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
                      echo "<li class='{$active}' ><a href='category.php?page=$i&c_id=$c_id'>$i</a></li>";
                    }
                    if($page < $totalpage){
                      echo "<li><a href='category.php?page=".((int)$page+1)."'>next</a></li>";


                    } 

                    ?>                    

                    <ul class='pagination'>
                    </ul>
                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
     </div>
    </div>
<?php include 'footer.php'; ?>
