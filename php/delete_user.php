<?php
    require __DIR__ . '/../connect_database.php';
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: ../index.php");
    }
    else{
        if ($_SESSION['role'] != 'admin') {
            header("Location: ../index.php");
        }
    }

    if(($_GET['id'])){
        $user_id = $_GET['id'];
        unlinkData('user_login', $user_id);
        header("Location: admin_page_user.php");
    }
?>