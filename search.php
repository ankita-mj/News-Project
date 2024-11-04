<?php 
  include 'header.php'; 
  include 'config.php';
?>

<div id="main-content">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                       if(isset($_GET['search'])){
                        $search_term = $_GET['search'];


                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                         }else{
                           $page = 1;
                         }
                         $limit = 3; 
                         $offset = ($page-1)*$limit;
                                             
                        echo $sql = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post_title LIKE '%{$search_term}%' ORDER BY post_id DESC LIMIT {$offset},{$limit}";
                        $result = mysqli_query($conn,$sql);
                    ?>
                    <h2 class="page-heading">Search :
                        <?php echo $search_term?>
                    </h2>
                    <div class="post-content">
                        <?php
                          while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id']?>">
                                    <img src="admin/upload/<?php echo $row['post_img']?>" width="100%"
                                        alt="image not found" /></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                <h3><a href="single.php?id=<?php echo $row['post_id']?>"><?php echo $row['post_title']?></a></h3>

                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?c_id=<?php echo $row['category_id']?>'>
                                                <?php echo $row['category_name']?>
                                            </a>

                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?author_id=<?php echo $row['user_id']?>'>
                                                <?php echo $row['f_name']." ".$row['l_name']?>
                                            </a>

                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']?>
                                        </span>
                                    </div>
                                    <p class="description">
                                        <?php echo substr($row['post_description'],0,150)."..."?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']?>'>
                                        read more
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }}

                    $sql2 = "SELECT * FROM post WHERE post_title LIKE '%{$search_term}%';";
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
                      echo "<li class='{$active}' ><a href='category.php?page=$i&search=$search_term'>$i</a></li>";
                    }
                    if($page < $totalpage){
                      echo "<li><a href='category.php?page=".((int)$page+1)."'>next</a></li>";


                    } 


                     ?>
                </div><!-- /post-container -->
            
            <!-- <div class="col-md-4"> -->
            <?php include 'sidebar.php'; ?>
            <!-- </div> -->
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>