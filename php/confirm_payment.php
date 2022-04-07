<?php
    session_start();
    require __DIR__ . '/checkout_data.php';
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $address = $_REQUEST['address'];
        $sale_ids = getSaleIds();
        foreach($sale_ids as $sale_id){
            $sql = "UPDATE sale_order SET address = '$address' WHERE id = $sale_id";
            mysqli_query($connect,$sql);
        }
        $_SESSION['sale_ids'] = null;
    }
    header("Location: payment.php");
?>