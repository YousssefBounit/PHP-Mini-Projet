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
            ob_start();
            include_once('include/indexStyle.css');
        ?>
    </style>
</head>
<body>
    <?php include_once('include/nav.php'); ?>
    <?php
    
    ?>
    <div class="content">
        <div class="container">
            <br>
            <div class="ms-5 row g-2 justify-content-center">
                <div style="height:60px;">
                <?php
                @session_start();

                include_once('DataBase/db.php');
                $sqlState = $pdo->query("SELECT * FROM products");
                $sqlState->execute();
                $products = $sqlState->fetchALL(PDO::FETCH_OBJ);
                if(isset($_POST['add'])){


                    if(empty($_SESSION['login'])){
                        ?>
                            <div class="justify-content-center" style="margin-top: -10px;">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="alert alert-danger col-md-6" style="height: 62px;">
                                        <form method="post">To Buy The <b>Product</b> Please Login !!! <input class="btn btn-danger" formaction="login.php" type="submit" name="cart" value="Log in" style="margin-top: -5px;">
                                        <button type="button" class="btn-close mt-1 float-end" data-bs-dismiss="alert" aria-label="Close"></button></form>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }else{
                        
                    $iduser = $_POST['iduser'];
                    $idProducts = $_POST['idProducts'];
                    $Productname = $_POST['Productname'];
                    $Productprice = $_POST['Productprice'];
                    $Productimg = $_POST['Productimg'];
                    $quantity = $_POST['quantity'];
                    $generaltotal=1;
                    $sqlStates = $pdo->prepare("SELECT * FROM cart WHERE idProducts=$idProducts And id=$iduser");
                    $sqlStates->execute();
                    
                    if($sqlStates->rowCount()>=1){
                        ?>
                            <div class="justify-content-center" style="margin-top: -10px;">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="alert alert-warning col-md-6" style="height: 62px;">
                                        <form method="post">This <b>Product</b> already in Your Cart !!! <input class="btn btn-warning" formaction="cart.php" type="submit" name="cart" value="My Cart" style="margin-top: -5px;">
                                        <button type="button" class="btn-close mt-1 float-end" data-bs-dismiss="alert" aria-label="Close"></button></form>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }else{
                    $sqlstat = $pdo->prepare("INSERT INTO cart VALUES(?,?,?,?,?,?,?,?);");
                    $sqlstat->execute([$iduser,$idProducts,$Productname,$Productprice,$Productimg,$quantity,$Productprice*$quantity,$generaltotal]);

                    $sqlState = $pdo->query("SELECT sum(total) AS gen FROM cart WHERE id ='$iduser';");
                    $sqlState->execute();
                    $gen=$sqlState->fetch(PDO::FETCH_OBJ);    
                    
                    $sqlStates=$pdo->prepare("UPDATE cart SET generaltotal=? WHERE id='$iduser';");
                    $res = $sqlStates->execute([$gen->gen]);
                    
                    ?>
                        <div class="justify-content-center" style="margin-top: -10px;">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="alert alert-success col-md-6" style="height: 62px;">
                                    <form method="post">Your <b>Product</b> has been Successfully added to your Cart !!! <input class="btn btn-success" formaction="cart.php" type="submit" name="cart" value="My Cart" style="margin-top: -5px;">
                                    <button type="button" class="btn-close mt-1 float-end" data-bs-dismiss="alert" aria-label="Close"></button></form>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
            }
                ?>
                </div>
                <?php
                foreach($products as $key => $product){
                    
                    ?>
                    <div class="col">
                        <div class="card border-5 border-secondary" style=" width: 270px; height: auto;">
                        <img src="Productimg/<?=$product->Productimg?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?=$product->Productname?></h5>
                                <span class="card-title" style="font-size:25px; margin-left:5px;"><?=$product->Productprice?> $</span>
                                <form method="post">
                                    <input type="number" value="1" name="quantity" min="1" max="10" class="form-control" style="width:70px; margin-top: -39px; margin-left: 165px;">
                                    <div class="d-flex align-items-center justify-content-center p-1">
                                        <input type="submit" name="add" value="Add To My Cart" class="btn btn-danger">
                                    </div>
                                    <input type="hidden" name="iduser" value="<?=@$_SESSION['login']['id']?>">
                                    <input type="hidden" name="idProducts" value="<?=$product->idProducts?>">
                                    <input type="hidden" name="Productname" value="<?=$product->Productname?>">
                                    <input type="hidden" name="Productprice" value="<?=$product->Productprice?>">
                                    <input type="hidden" name="Productimg" value="<?=$product->Productimg?>">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                
            }
                ?>
            </div>
            <br><br>
        </div>
    </div>
<?php include_once('include/footer.php'); ?>
</body>
</html>