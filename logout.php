<?php
    session_start();
    if(empty($_SESSION['login'])){
        header('location:index.php');
    }else{
        if(isset($_POST['logout'])){
            session_start();
            if(session_destroy()){
                header('location:index.php');
            }
        }
    }
?>