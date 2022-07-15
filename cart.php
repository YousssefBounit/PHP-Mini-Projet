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
                    <div class="col-md-10 d-flex align-items-center justify-content-center border border-3 bg-dark" style=" border-radius: 20px; position:relative;">
                        <div class="col-md-12">
                        <h2 class="text text-center text-white mt-5">My Cart</h2><br>
                            <div class="card col-md-12">
                                <div class="card-header col-md-12">
                                    <h2>Shopping Cart</h2>
                                </div>
                                <div class="card-body col-md-12">
                                    <?php
                                    include_once('DataBase/db.php');
                                        @session_start();
                                        $id = $_SESSION['login']['id'];
                                        $sqlStats = $pdo->query("SELECT * FROM cart WHERE id=$id");
                                        $sqlStats->execute();
                                        $carttotal = $sqlStats->fetch(PDO::FETCH_OBJ);

                                        $sqlStat=$pdo->prepare("SELECT sum(Productprice*quantity) AS total FROM cart WHERE id =$id;");
                                        $sqlStat->execute();
                                        $total = $sqlStat->fetch(PDO::FETCH_OBJ);

                                        $shipping = $total->total*(20/100);
                                        if($sqlStats->rowCount()>=1){

                                            ?>
                                                <table class="table table-bordered col-md-12">
                                                    <thead class="col-md-12">
                                                        <tr>
                                                            <th class="text-center col-md-5" >Product Name</th>
                                                            <th class="text-center  col-md-2" >Price</th>
                                                            <th class="text-center  col-md-2">Quantity</th>
                                                            <th class="text-center  col-md-2">Total</th>
                                                            <th class="text-center col-md-1">Delete</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="col-md-12">
                                                            <?php 
                                                            @session_start();
                                                            $id = $_SESSION['login']['id'];
                                                            include_once('DataBase/db.php');
                                                            $sqlState = $pdo->query("SELECT * FROM cart WHERE id=$id");
                                                            $sqlState->execute();
                                                            $carts = $sqlState->fetchALL(PDO::FETCH_OBJ);
                                                            
                                                            if(isset($_POST['save'])){
                                                                $quantity=$_POST['newquantity'];
                                                                $idProducts=$_POST['idProducts'];
                                                                $sqlStates=$pdo->prepare('UPDATE cart SET quantity=? WHERE idProducts=?;');
                                                                $res = $sqlStates->execute([$quantity,$idProducts]);


                                                                $sqlStat=$pdo->prepare("SELECT sum(Productprice*quantity) AS total FROM cart WHERE id =$id;");
                                                                $sqlStat->execute();
                                                                $total = $sqlStat->fetch(PDO::FETCH_OBJ);

                                                                header("Refresh:0");
                                                            }
                                                            if(isset($_POST['delete'])){
                                                                $idProducts=$_POST['idProducts'];
                                                                $sqlState = $pdo->prepare('DELETE FROM cart WHERE idProducts=?');
                                                                $result = $sqlState->execute([$idProducts]);
                                                                header("Refresh:0");
                                                            }
                                                            if(isset($_POST['clear'])){
                                                                $id=$_SESSION['login']['id'];
                                                                $sqlState = $pdo->prepare('DELETE FROM cart WHERE id=?');
                                                                $result = $sqlState->execute([$id]);
                                                                header("Refresh:0");
                                                            }
                                                            if(isset($_POST['Checkout'])){
                                                                $card=$_POST['card'];
                                                                $month=$_POST['month'];
                                                                $cvv=$_POST['cvv'];
                                                                if(!empty($card) && !empty($month) && !empty($cvv)){
                                                                        $id=$_SESSION['login']['id'];
                                                                        $sqlState = $pdo->prepare('DELETE FROM cart WHERE id=?');
                                                                        $result = $sqlState->execute([$id]);
                                                                        header("Refresh:3");
                                                                    ?>
                                                                    <br>
                                                                        <div class="d-flex align-items-center justify-content-center" style="height: 100px;">
                                                                            
                                                                            <div class="alert alert-success col-md-8" style="height: 59px;">
                                                                                <form method="post">
                                                                                <span class="text-right">Purchase Completed successfully !!!</span><input class="btn btn-success float-end" formaction="shoop.php" type="submit" name="shoop" value="Go To Shoop" style="margin-top: -6px;">
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                        
                                                                }else{
                                                                    ?>
                                                                        <div class="d-flex align-items-center justify-content-center" style="height: 100px;">
                                                                            
                                                                            <div class="alert alert-danger col-md-6" style="height: 59px;">
                                                                                <span class="text-right">Credit card informations required</span>
                                                                                <button type="button" class="btn-close mt-1 float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                }
                                                            }
                                                              

                                                            foreach($carts as $key => $cart){
                                                                
                                                                ?>
                                                                    <tr>
                                                                        <form method="post">
                                                                        <td class="p-4">
                                                                        <div class="align-items-center">
                                                                            <img src="Productimg/<?=$cart->Productimg?>" class=" mr-4" width="60px" height="60px">
                                                                            <span class="text text-center text-dark"><?=$cart->Productname?></span>
                                                                            <input type="hidden" value="<?=$_SESSION['login']['id']?>">
                                                                            <input type="hidden" name="idProducts" value="<?=$cart->idProducts?>">
                                                                            <input type="hidden" name="Productprice" value="<?=$cart->Productprice?>">
                                                                        </div>
                                                                        </td>
                                                                        <td class="text-right font-weight-semibold align-middle p-4"><?=$cart->Productprice?> <b> $ </b></td>
                                                                        <td class="text-center align-middle px-0"><div class="d-flex align-items-center justify-content-center">
                                                                            <input type="number" name="newquantity" class="form-control text-center" max="10" min="1" name="newquantity" value="<?=$cart->quantity?>" style="width: 80px;">
                                                                            <input type="submit" value="save" name="save" class="btn btn-primary ms-3"></div>
                                                                        </td>
                                                                        <td class="text-right font-weight-semibold align-middle p-4"><?=$cart->Productprice*$cart->quantity?> <b>$</b></td>
                                                                        <td class="text-center align-middle px-0">
                                                                            <input type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are You sure You want delete (<?=$cart->Productname?>) From Cart')" style="color:white; font-size:17px; font-weight: bold;" value="&#10005;">
                                                                        </td>
                                                                        </form>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                
                                                            ?>
                                                        </tbody>
                                                </table>
                                            <?php
                                            ?>
                                            <br>
                                            <div>
                                                <div class="float-start ms-4">
                                                    <img src="svgs/visa .png" width="65px">
                                                    <img src="svgs/master.png" width="65px">
                                                    <img src="svgs/paypal.png" width="90px">
                                                    <img src="svgs/exp.png" width="75px">
                                                    <img src="svgs/discover.png" width="70px">
                                                    <img src="svgs/amazon .png" width="70px">
                                                </div>
                                                <div class="float-end">
                                                    <form method="post">
                                                        <input class="btn btn-danger" type="submit" name="clear" onclick="return confirm('Are You sure You want Clear All from Your Cart')" value="Clear All">
                                                    </form>
                                                </div>
                                             </div>   
                                            <?php
                                        }else{
                                            ?>
                                            <br>
                                                <div class="d-flex align-items-center justify-content-center" style="height: 100px;">
                                                    
                                                    <div class="alert alert-info col-md-8" style="height: 59px;">
                                                        <form method="post">
                                                        <span class="text-right">Your Shooping <b> cart </b> is empty !!!</span><input class="btn btn-info float-end" formaction="shoop.php" type="submit" name="shoop" value="Go To Shoop" style="margin-top: -6px;">
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php
                                        }


                                    ?>
                                    
                                    </div>
                                    <div>
                                        <form method="post">
                                            <div class="card float-start ms-5 col-md-6">
                                                <div class="card-header">
                                                    Add Your Credit Card
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <span class="text-muted font-weight-normal m-0">Credit Card Number : </span>
                                                        <div>
                                                            <div class="col-md-5 float-start">
                                                                <input type="number" name="card" id="num" class="form-control" placeholder="1111-2222-3333-4444">
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item"><span class="text-muted font-weight-normal m-0">Expiration Date : </span>
                                                        <div>
                                                            <div class="col-md-5 float-start">
                                                                <input type="month" name="month" class="form-control">
                                                            </div>
                                                        </div>
                                                        
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="text-muted font-weight-normal m-0">Card Verification Number : </span>
                                                        <div>
                                                            <div class="col-md-5 float-start">
                                                                <input type="number" id="num" name="cvv" class="form-control" placeholder="CVC/CVV">
                                                            </div>
                                                        </div> 
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="card float-start ms-2 col-md-4">
                                                <div class="card-header">
                                                    Order
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><span class="text-muted font-weight-normal m-0">Total price : </span><strong><?=$total->total?> $</strong></li>
                                                    <li class="list-group-item"><span class="text-muted font-weight-normal m-0">Shipping : </span><strong><?=$shipping?> $</strong></li>
                                                    <li class="list-group-item"><span class="text-muted font-weight-normal m-0">Total : </span><strong><?=$total->total+$shipping?> $</strong></li>
                                                </ul>
                                            </div>
                                            <div class="float-start ms-4 mt-2">
                                            <form method="post">
                                                <input type="submit" formaction="shoop.php" value="Back to shopping" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">
                                                <input type="submit" name="Checkout" value="Checkout" class="btn btn-lg btn-success mt-2">
                                            </form>
                                            </div>
                                        </form>
                                    </div>
                                    <br><br>
                                </div>
                                <br><br>
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