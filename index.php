<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="logo/logo.svg">
    <script src="bootstrap5/js/bootstrap.bundle.js"></script>
    <title>YAA-Anime</title>
    <style>
       <?php
       @session_start();
       include_once('include/indexStyle.css'); ?>
    </style>
</head>
<body>
    <?php include_once('include/nav.php');?>
    <div class="content" style="height: 100vh;">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                </div>
                <?php
                @session_start();
                if(empty($_SESSION['login'])){
                ?>
                    <div class="col-md-5 text text-white text-center" style="margin-top: 300px;">
                        <h2>Welcome to YAA-Anime</h2>
                        <h5>This website is for
                            people interested
                            to Anime One Piece.
                        </h5>
                        <br>
                        <form method="post">
                            <input type="submit" formaction="login.php" class="btn btn-danger" value='Log in'>
                        </form>
                    </div>
                <?php

                }else{
                ?>
                    <div class="col-md-5 text text-white text-center" style="margin-top: 300px;">
                        <h2>Welcome <span class="text text-danger"><?=$_SESSION['login']['username']?></span> to YAA-Anime</h2>
                        <h5>This website is for
                            people interested
                            to Anime One Piece.
                        </h5>
                        <br>
                        <form method="post">
                            <input type="submit" formaction="profile.php" class="btn btn-danger" value='Your Profile'>
                        </form>
                    </div>
                <?php
                }
                
                ?>
            </div>
        </div>
    </div>
    <?php include_once('include/footer.php');?>
</body>
</html>