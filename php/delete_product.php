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
        $product_id = $_GET['id'];
        unlinkData('product_template', $product_id);
        header("Location: admin_page_product.php");
    }
?>