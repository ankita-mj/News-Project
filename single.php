<?php
    include 'header.php'; 
    include "config.php";    
?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <?php
                        $conn = mysqli_connect("localhost","root","padduu","news",3307);
                        //$sql = "SELECT * FROM post LEFT JOIN catagory ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id";
                        $sql = "SELECT * FROM post, category, user WHERE post.category = category.category_id AND post.author = user.user_id AND post_id = {$_GET['id']}";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="post-content single-post">
                            <h3><?php echo $row['post_title']?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href="category.php?c_id=<?= $row['category_id']?>"><?php echo $row['category_name']?></a>
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
                            <img class="single-feature-image" src="admin/upload/<?= $row['post_img']?>" alt="img not uploaded"/>
                            <p class="description">
                              <?php echo $row['post_description']?>                           
                            </p>
                        </div>
                        <?php
                          
                        }
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
