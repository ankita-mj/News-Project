<?php
include 'config.php';
session_start();
   if(isset($_SESSION['user_id'])){
        header("location: {$host}/admin/post.php");
   }
?>


<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
   if(isset($_POST['login'])){
        echo $username = mysqli_real_escape_string($conn,$_POST['username']);
        echo $password = md5($_POST['password']);
        $sql = "SELECT user_id, u_name, role FROM user WHERE u_name = '{$username}' AND password = '{$password}'" or die("query failed");
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                 session_start();
                 $_SESSION['user_id'] = $row['user_id'];
                 $_SESSION['u_name'] = $row['u_name'];
                 $_SESSION['role'] = $row['role'];
                 header("location: {$host}/admin/post.php");
            }
        }else{
          echo "<div class='alert alert-danger'>username password not matched</div>";  
        }

   }


