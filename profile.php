<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="logo/logo.svg">
    <script src="bootstrap5/js/bootstrap.bundle.js"></script>
    <title>My Profile</title>
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
                    <div class="col-md-8 d-flex align-items-center justify-content-center border border-3 bg-dark" style=" border-radius: 20px; position:relative;">
                        <div class="col-md-9">
                        <h2 class="text text-center text-white mt-5">My Profile</h2>
                        <div style="height:60px;">
    <?php
        include_once('DataBase/db.php');
        
        if (isset($_POST['delete'])){
            $id = $_POST['id'];
            $sqlState = $pdo->prepare('DELETE FROM users WHERE id=?');
            $result = $sqlState->execute([$id]);
                    session_start();
                    if(session_destroy()){
                        header('location:login.php');
                    }
            header('location: index.php');
        }


        $id = $_SESSION['login']['id'];
        $photo = $_SESSION['login']['ppicture'];
        $sqlState = $pdo->prepare('SELECT * FROM users WHERE id=?');
        $sqlState->execute([$id]);
        $users = $sqlState->fetch(PDO::FETCH_OBJ);
        if(isset($_POST['Save'])){
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
                                                $name_file = $photo;
                                            }
                                        }
                                        include_once('DataBase/db.php');
                                        $sqlstats = $pdo->prepare('UPDATE users SET username=? , first=? , last=? , email=? , phone=? , password=? , country=? , city=? , date=? , gender=? , ppicture=? WHERE id=?');
                                        $res = $sqlstats->execute([$username,$first,$last,$email,$phone,$password,$country,$city,$date,$gender,$name_file,$id]);
                                        session_destroy();
                                        $stats = $pdo->prepare('SELECT * FROM users WHERE username = ? AND password = ? ');
                                        $res = $stats->execute([$username,$password]);
                                        session_start();
                                        header("Refresh:2");
                                        $_SESSION['login'] = $stats->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="alert bg-success text-center text-white" style="height: 50px;">
                                                    <span style="position:relative; top:-5px;"><b>loading...</b></span>
                                                    <span style="position:relative; top:-5px;" class="align" id='timer'><b>2</b></span>
                                                    <div class="spinner-border" role="status" style="float: right; margin-left:15px; position:relative; top:-8px;"></div>
                                                    <script>
                                                        const timer = document.getElementById('timer');
                                                        let time = 2;
                                                        const countdown = setInterval(()=>{
                                                            time--;
                                                            timer.innerHTML = `<b>${time}</b>`;
                                                        },1000)

                                                    </script>
                                                </div>
                                            </div>
                                        <?php
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
                                                    $name_file = $photo;
                                                }
                                            }
                                            include_once('DataBase/db.php');
                                            $sqlstats = $pdo->prepare('UPDATE users SET username=? , first=? , last=? , email=? , phone=? , password=? , country=? , city=? , date=? , gender=? , ppicture=? WHERE id=?');
                                            $res = $sqlstats->execute([$username,$first,$last,$email,$phone,$password,$country,$city,$date,$gender,$name_file,$id]);
                                            session_destroy();
                                            $stats = $pdo->prepare('SELECT * FROM users WHERE username = ? AND password = ? ');
                                            $res = $stats->execute([$username,$password]);
                                            session_start();
                                            header("Refresh:2");
                                            $_SESSION['login'] = $stats->fetch(PDO::FETCH_ASSOC);
                                            ?>

                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="alert bg-success text-center text-white" style="height: 50px;">
                                                        <span style="position:relative; top:-5px;"><b>loading...</b></span>
                                                        <span style="position:relative; top:-5px;" class="align" id='timer'><b>2</b></span>
                                                        <div class="spinner-border" role="status" style="float: right; margin-left:15px; position:relative; top:-8px;"></div>
                                                        <script>
                                                            const timer = document.getElementById('timer');
                                                            let time = 2;
                                                            const countdown = setInterval(()=>{
                                                                time--;
                                                                timer.innerHTML = `<b>${time}</b>`;
                                                            },1000)
                                                        </script>
                                                    </div>
                                                </div>
                                            <?php
                            
                                        }else{
                                            ?>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="alert alert-danger col-md-7">
                                                        Your <b>Picture Extension</b> is not Allowed !!!
                                                        <button type="button" class="btn-close mt-1 float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                        }  
                            }
                                }else{
                                    ?>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="alert alert-danger col-md-7">
                                                Your phone must be more than <b>10</b> numbers !!!
                                                <button type="button" class="btn-close mt-1 float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }else{
                                ?>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="alert alert-danger col-md-6">
                                            You age is under <b>18</b> years !!!
                                            <button type="button" class="btn-close mt-1 float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="alert alert-danger col-md-6">
                                    The Password don't match !!!
                                    <button type="button" class="btn-close mt-1 float-end" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                <button type="button" class="btn-close mt-1 float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    <?php
                }
            
        }
    
    ?>
                        </div>
                            <div class="signup-form">
                                <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=$users->id?>">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img id="profileimg" style="border-radius: 50%; border:5px solid rgb(190, 19, 19);" src="PPicture/<?=$_SESSION['login']['ppicture'];?>" width="150px" height="149px"/><br>
                                    <div class="cam" style="width: 34px; height: 34px; line-height: 33px; border-radius: 50%;
                                         overflow: hidden; position:relative;left:-5%; top:50px; border:3px solid rgb(190, 19, 19);">
                                        <input type="file" id="photo" name="Picture" style="position: absolute; transform: scale(2); opacity: 0;">
                                        <img name="Picture" class="bg-white" src="logo/camer.png" 
                                        width="35px" height="35px" style=" margin-top:-9.2px; margin-left:-3.2px;"/><br>
                                    </div>
                                    <script>
                                        const profile = document.querySelector('#profileimg');
                                        const file = document.querySelector('#photo');
                                        profile.onclick=function(){
                                            file.click();
                                        }
                                        const image_input = document.querySelector("#photo");
                                        image_input.addEventListener("change", function() {
                                        const reader = new FileReader();
                                        reader.addEventListener("load", () => {
                                            const uploaded_image = reader.result;
                                            document.querySelector('#profileimg').src = `${uploaded_image}`;
                                        });
                                        reader.readAsDataURL(this.files[0]);
                                        });
                                    </script>
                                </div>
                                    <div class="row">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="col-md-6">
                                                <label class="text text-white">Username : </label>
                                                <input type="text" value="<?=$users->username?>" name="username" class="form-control" placeholder="username...">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">First Name : </label>
                                            <input type="text" value="<?=$users->first?>" name="first" class="form-control" placeholder="first Name...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Last Name : </label>
                                            <input type="text" value="<?=$users->last?>" name="last" class="form-control" placeholder="last Name...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Email : </label>
                                            <input type="email" value="<?=$users->email?>" name="email" class="form-control" placeholder="email...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Phone : </label>
                                            <input type="tel" value="<?=$users->phone?>" name="phone" class="form-control" placeholder="phone"> 
                                        </div>
                                        <div class="col-md-12">
                                            <label class="text text-white">Password : </label>
                                            <input type="password" value="<?=$users->password?>" name="password" class="form-control" placeholder="password...">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="text text-white">Confirm Password : </label>
                                            <input type="password" value="<?=$users->password?>" name="cpass" class="form-control" placeholder="Confirm Password...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Country : </label>
                                            <input type="text" value="<?=$users->country?>" name="country" class="form-control" placeholder="country...">                              
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">City : </label>
                                            <input type="text" value="<?=$users->city?>" name="city" class="form-control" placeholder="city...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Date Of Birth : </label>
                                            <input type="date" value="<?=$users->date?>" name="date" class="form-control" placeholder="date...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text text-white">Gender : </label>
                                            <select name="gender" class="form-select" aria-label="Default select example">
                                                <option selected value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select><br>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <br><br>
                                            <div>
                                                <input type="submit" name="Save" value="Save" class="btn btn-success" style="width: 135px;">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <br><br>
                                            <div>
                                                <input type="submit" name="delete" value="Delete Account" onclick="return confirm('Are You sure You want delete Your Account')" class="btn btn-danger" style="width: 135px;">
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