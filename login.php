<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="logo/logo.svg">
    <script src="bootstrap5/js/bootstrap.bundle.js"></script>
    <title>login</title>
    <style>
      <?php
      ob_start();
      include_once('include/indexStyle.css');?>
    </style>
</head>
<body>
    <?php include_once('include/nav.php'); ?>
        <div class="content">
            <div class="d-flex align-items-center justify-content-center" style="height:80vh;">
                 <div class="col-md-6 border border-3" style="height:650px; border-radius: 20px; background-color: rgb(190, 19, 19); position:relative;" >
                    <h2 class="text text-center text-white mt-5">login</h2>
    <?php
        @session_start();
        if(!empty($_SESSION['login'])){
            header('location:index.php');
        }
        if(isset($_POST['cnx'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            if(!empty($username) && !empty($password)){
                include_once('DataBase/db.php');
                $stats = $pdo->prepare('SELECT * FROM users WHERE username = ? AND password = ? ');
                $res = $stats->execute([$username,$password]);
                if($stats->rowCount()>=1){
                    $_SESSION['login'] = $stats->fetch(PDO::FETCH_ASSOC);
                    header('Location:index.php');
                    
                }else{
                    ?>
                    <div class="d-flex align-items-center justify-content-center" style="margin-top: 70px;">
                        <div class="alert alert-danger col-md-6">
                            Username Or Password Incorrect !!!
                        </div>
                    </div>
                    <?php 
                }
            }else{
                    ?>
                    <div class="d-flex align-items-center justify-content-center" style="margin-top: 70px;">
                        <div class="alert alert-danger col-md-6">
                            All Fields Are Mandatory !!!
                        </div>
                    </div>
                    <?php 
            }
        }
    ?>
                            <div class="d-flex align-items-center justify-content-center" style="margin-top: 70px; padding-right:30px;">
                                <form method="post">
                                    <div class="container">
                                    <label class="text-white" style="margin-left: 35px;">
                                        <h6>Username :</h6></label><br>
                                        <img src="logo/user.svg" width="26px" height="26px" />
                                        <input type="text" name="username" class="form-control" placeholder="username..." style="margin-left:35px; margin-top:-32px; margin-right:35px;"><br>
                                        <label class="text-white" style="margin-left: 35px;">
                                        <h6>Password :</h6></label><br>
                                        <img src="logo/password.svg" width="26px" height="26px" />
                                        <input type="password" name="password" class="form-control" placeholder="password..." style="margin-left:35px; margin-top:-33px;margin-right:35px;"><br>
                                        <div class="text text-center text-white" style="margin-left: 30px;">
                                            <span>Don't have an accont ? &nbsp; </span><a href="registration.php" class="text text-dark"><b>Register Now</b></a>
                                        </div>
                                        <br>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <input type="submit" name="cnx" value="Login" class="btn btn-dark" style="width: 100px; margin-left:37px;">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <?php include_once('include/footer.php');
    ob_end_flush(); ?>
</body>
</html>