<header class="bg-dark">
    <div class="container-fluid">
        <div class="container col-md-10">
            <nav class="navbar navbar-expand-md navbar-dark">
                <a href="#" class="navbar-brand">
                    <img src="logo/logo.svg" width="30px" height="30px" class="d-inline-block align-top"/>
                    YAA-Anime</a>
                <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#toggleMobileMenu"
                aria-controls="toggleMobileMenu"
                aria-expanded="false"
                aria-lable="Toggle navigation"
                >
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="toggleMobileMenu">
                    <?php
                    @session_start();
                    if(empty($_SESSION['login'])){

                        ?>
                        <ul class="navbar-nav ms-auto text-center"> 
                            <li>
                                <a href="index.php" class="nav-link botn">YAA-Anime</a>
                            </li>
                            <li>
                                <a href="home.php" class="nav-link botn">Home</a>
                            </li>
                            <li>
                                <a href="The Story.php" class="nav-link botn">Story</a>
                            </li>
                            <li>
                                <a href="Character List.php" class="nav-link botn">Characters</a>
                            </li>
                            <li>
                                <a href="Author.php" class="nav-link botn">Author Actors</a>
                            </li>
                            <li>
                                <a href="shoop.php" class="nav-link botn">Shoop</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav text-center" style="padding-left:5px; padding-right:5px; border:2px solid rgb(207, 39, 39); border-radius: 10px;">
                            <li>
                                <a href="login.php" class="nav-link botn">login</a>
                            </li>
                        </ul>
                    <?php

                    }else{
                        ?>
                            <ul class="navbar-nav ms-auto text-center">
                                <li>
                                    <a href="index.php" class="nav-link botn">YAA-Anime</a>
                                </li>
                                <li>
                                    <a href="home.php" class="nav-link botn">Home</a>
                                </li>
                                <li>
                                    <a href="The Story.php" class="nav-link botn">Story</a>
                                </li>
                                <li>
                                    <a href="Character List.php" class="nav-link botn">Characters</a>
                                </li>
                                <li>
                                    <a href="Author.php" class="nav-link botn">Author Actors</a>
                                </li>
                                <li>
                                    <a href="shoop.php" class="nav-link botn">Shoop</a>
                                </li>
                                <li class="nav-item dropdown" style=" margin-left: 20px; margin-top:3px;">
                                        <?php 
                                                @session_start();
                                                if(empty($_SESSION['login'])){
                                                    header('location:Login.php');
                                                }
                                        ?>
                                        <img  data-bs-toggle="dropdown" aria-expanded="false" 
                                        style="border:2px solid rgb(207, 39, 39); cursor: pointer; border-radius: 20px;" 
                                        src="PPicture/<?=$_SESSION['login']['ppicture'];?>" width="35px" height="35px"/>
                                        <ul class="dropdown-menu dropdown-menu-lg-end proof" aria-labelledby="navbarDropdownMenuLink" style="margin-top: 5px;">
                                            <div class="text text-end" style="font-size: 50px; color:white; margin-top:-35px; margin-right:2px;"><b>&#x26A8;</b></div>
                                            <li class="text text-center"><span class="text text-dark">User : <?=$_SESSION['login']['username'];?></span></li><br>
                                            <li class="text text-center"><a class="text text-dark nav-link botn" href="profile.php">My profile</a></li>
                                            <li class="text text-center"><a class="text text-dark nav-link botn" href="cart.php">My Cart</a></li><br>
                                            <form method="post">
                                            <li class="text text-center"><input class="loog" type="submit" formaction="logout.php" value="Logout" name="logout"
                                            style=" text-decoration:none; padding:10px; border:3px solid red; border-radius: 25px; padding-left:30px; padding-right:30px;"></li><br>
                                            </form>
                                        </ul>
                                </li>
                            </ul>
                        <?php

                    }
                        
                        ?>
                    </div>
                </nav>
            </div>
        </div>
</header>
    <span class="up"><p style="margin-top: 1.1px; margin-left: 9px; font-size: 24px;">&#10140;</p></span>
    <script src="javascript/btn_up.js"></script>