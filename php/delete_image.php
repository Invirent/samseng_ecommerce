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
        $image_id = $_GET['id'];
        unlinkData('image_editor', $image_id);
        header("Location: admin_image_editor.php");
    }
?>