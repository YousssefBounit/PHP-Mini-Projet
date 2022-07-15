<?php
require_once('DataBase/db.php');
if (isset($_POST['delete'])){
    $id = $_POST['id'];
    $sqlState = $pdo->prepare('DELETE FROM users WHERE id=?');
    $result = $sqlState->execute([$id]);
            session_start();
            if(session_destroy()){
                header('location:index.php');
            }
    header('location:index.php');
}

?>