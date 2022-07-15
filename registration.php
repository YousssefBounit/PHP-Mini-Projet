<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="logo/logo.svg">
    <script src="bootstrap5/js/bootstrap.bundle.js"></script>
    <title>Register</title>
    <style>
      <?php
      ob_start();
      include_once('include/indexStyle.css');?>
    </style>
</head>
<body>
    <?php include_once('include/nav.php'); ?>
    <div class="content">
            <div class="container">
                <br><br>
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-8 d-flex align-items-center justify-content-center border border-3" style=" border-radius: 20px; background-color: rgb(190, 19, 19); position:relative;">
                        <div class="col-md-9">
                        <h2 class="text text-center text-white mt-5">Register</h2><br>
    <?php
    if(isset($_POST['register'])){
        $username=$_POST['username'];
        $first=$_POST['first'];
        $last=$_POST['last'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $password=$_POST['password'];
        $cpass=$_POST['cpass'];
        $country=$_POST['country'];
        $city=$_POST['city'];
        $date=$_POST['date'];
        $gender=$_POST['gender'];
        if(!empty($username) && !empty($first) && !empty($last) && !empty($last) && !empty($email) && !empty($phone) && !empty($date)
            && !empty($password) && !empty($cpass) && !empty($country) && !empty($city) && !empty($gender)){
                if(strlen($password) < 8){
                    ?>
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="alert alert-danger col-md-">
                                Your Password is too short !!!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                            </div>
                        </div>
                    <?php
                }else{
                    if($password === $cpass){
                        $Age=date_diff(date_create($date),date_create('today'))->y;
                        if($Age >= 18){
                            if(strlen($phone) >= 10){
                                if($_FILES['Picture']['error']==4){
                                    if(isset($_FILES['Picture'])){
                                        $dossier = 'PPicture/';
                                        $fichier = basename($_FILES['Picture']['name']);
                                        $name_file = time().'-'.$fichier;
                                        $dist = $dossier . $name_file;
                                        
                                        if(move_uploaded_file($_FILES['Picture']['tmp_name'],$dist)){
                                            
                                        }else{
                                            $name_file = 'profile.png';
                                        }
                                        include_once('DataBase/db.php');
                                        $sqlstats = $pdo->prepare("SELECT * FROM users WHERE username='$username';");
                                        $res = $sqlstats->execute();
                                        if($sqlstats->rowCount()>=1){
                                            ?>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="alert alert-danger col-md-6">
                                                        Your <b>username</b> is already taken !!!
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                                                    </div>
                                                </div>
                                            <?php
                                        }else{
                                            $sqlstats = $pdo->prepare("SELECT * FROM users WHERE email='$email';");
                                            $res = $sqlstats->execute();
                                            if($sqlstats->rowCount()>=1){
                                                ?>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="alert alert-danger col-md-6">
                                                            Your <b>email</b> is already taken !!!
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                                                        </div>
                                                    </div>
                                                <?php
                                            }else{
                                                $sqlstats = $pdo->prepare('INSERT INTO users VALUES (null,?,?,?,?,?,?,?,?,?,?,?)');
                                                $res = $sqlstats->execute([$username,$first,$last,$email,$phone,$password,$country,$city,$date,$gender,$name_file]);
                                                header("Refresh:5;url=login.php");
                                                ?>
                                                    <div class="d-flex align-items-center justify-content-center"> 
                                                        <div class="alert alert-success col-md-12">
                                                            Your account has been created successfully, you will be sent to log in after : <b style="font-size: 23px;"><span id="timer">5</span></b> s !!!
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                                                            <script>
                                                                const timer = document.getElementById('timer');
                                                                let time = 6;
                                                                const countdown = setInterval(()=>{
                                                                    time--;
                                                                    timer.innerHTML = `${time}`;
                                                                },1000)
                                                            </script>
                                                        </div>
                                                    </div>
                                                <?php
                                            }
                                        }
                                    }
                                }else{
                                    if(isset($_FILES['Picture'])){
                                        $dossier = 'PPicture/';
                                        $fichier = basename($_FILES['Picture']['name']);
                                        $ext=explode(".",$fichier);
                                        $cont=count($ext);
                                        if($ext[$cont-1]=='jpg'|| $ext[$cont-1]=='png'|| $ext[$cont-1]=='jpeg'){
                                        if(isset($_FILES['Picture'])){
                                                $dossier = 'PPicture/';
                                                $fichier = basename($_FILES['Picture']['name']);
                                        $name_file = time().'-'.$fichier;
                                        $dist = $dossier . $name_file;
                                        
                                        if(move_uploaded_file($_FILES['Picture']['tmp_name'],$dist)){
                                            
                                        }else{
                                            $name_file = 'profile.png';
                                        }
                                        include_once('DataBase/db.php');
                                        $sqlstats = $pdo->prepare("SELECT * FROM users WHERE username='$username';");
                                        $res = $sqlstats->execute();
                                        if($sqlstats->rowCount()>=1){
                                            ?>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="alert alert-danger col-md-6">
                                                        Your <b>username</b> is already taken !!!
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                                                    </div>
                                                </div>
                                            <?php
                                        }else{
                                            $sqlstats = $pdo->prepare("SELECT * FROM users WHERE email='$email';");
                                            $res = $sqlstats->execute();
                                            if($sqlstats->rowCount()>=1){
                                                ?>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="alert alert-danger col-md-6">
                                                            Your <b>email</b> is already taken !!!
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                                                        </div>
                                                    </div>
                                                <?php
                                            }else{
                                                $sqlstats = $pdo->prepare('INSERT INTO users VALUES (null,?,?,?,?,?,?,?,?,?,?,?)');
                                                $res = $sqlstats->execute([$username,$first,$last,$email,$phone,$password,$country,$city,$date,$gender,$name_file]);
                                                header("Refresh:5;url=login.php");
                                                ?>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="alert alert-success col-md-12">
                                                            Your account has been created successfully, you will be sent to log in after : <b style="font-size: 23px;"><span id="timer">3</span></b> s !!!
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                                                            <script>
                                                                const timer = document.getElementById('timer');
                                                                let time = 3;
                                                                const countdown = setInterval(()=>{
                                                                    time--;
                                                                    timer.innerHTML = `${time}`;
                                                                },1000)
                                                            </script>
                                                        </div>
                                                    </div>
                                                <?php
                                            }
                                        }
                                    }
                                    
                                        }
                                        }else{
                                            ?>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="alert alert-danger col-md-6">
                                                        Your <b>Picture Extension</b> is not Allowed !!!
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    }
                                           
                                            
                            }else{
                                ?>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="alert alert-danger col-md-7">
                                            Your phone must be more than <b>10</b> numbers !!!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                                        </div>
                                    </div>
                                <?php
                            }
                        }else{
                            ?>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="alert alert-danger col-md-6">
                                        You age is under <b>18</b> years !!!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                                    </div>
                                </div>
                            <?php
                        }
                    }else{
                        ?>
                           <div class="d-flex align-items-center justify-content-center">
                               <div class="alert alert-danger col-md-6">
                                   The Password don't match !!!
                                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                               </div>
                           </div>
                       <?php
                    }
                
                }
            
            }else{
                ?>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="alert alert-danger col-md-6">
                            All Fields Are Mandatory !!!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                        </div>
                    </div>
                <?php
            }
    }
    ?>
                            <div class="signup-form">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="col-md-6">
                                                <label class="text text-white">Username : </label>
                                                <input type="text" value="<?=@$username?>" name="username" class="form-control" placeholder="username...">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">First Name : </label>
                                            <input type="text" value="<?=@$first?>" name="first" class="form-control" placeholder="first Name...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Last Name : </label>
                                            <input type="text" value="<?=@$last?>" name="last" class="form-control" placeholder="last Name...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Email : </label>
                                            <input type="email" value="<?=@$email?>" name="email" class="form-control" placeholder="email...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Phone : </label>
                                            <input type="tel" value="<?=@$phone?>" name="phone" class="form-control" placeholder="phone"> 
                                        </div>
                                        <div class="col-md-12">
                                            <label class="text text-white">Password : </label>
                                            <input type="password" value="<?=@$password?>" name="password" class="form-control" placeholder="password...">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="text text-white">Confirm Password : </label>
                                            <input type="password" value="<?=@$cpass?>" name="cpass" class="form-control" placeholder="Confirm Password...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Country : </label>
                                            <input type="text" value="<?=@$country?>" name="country" class="form-control" placeholder="country...">                              
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">City : </label>
                                            <input type="text" value="<?=@$city?>" name="city" class="form-control" placeholder="city...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Date Of Birth : </label>
                                            <input type="date" value="<?=@$date?>" name="date" class="form-control" placeholder="date...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Gender : </label>
                                            <select name="gender" class="form-select" aria-label="Default select example">
                                                <option selected value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="col-md-6">
                                                <label class="text text-white">Profile picture : </label>
                                                <input type="file" name="Picture" class="form-control"><br>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="text text-center text-white" style="margin-left: 30px;">
                                                <span>Already have an account ? &nbsp; </span><a href="login.php" class="text text-dark"><b>Login Now</b></a>
                                            </div>
                                        </div><br><br>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <br><br>
                                            <div>
                                                <input type="submit" name="register" value="Register" class="btn btn-dark" style="width: 120px;">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <br><br>
                        </div>
                    </div>
                </div>
                <br><br>    
            </div>
        </div>
    <?php include_once('include/footer.php');
    ob_end_flush(); ?>
</body>
</html>