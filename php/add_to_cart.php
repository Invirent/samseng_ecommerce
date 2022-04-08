<?php 
    require __DIR__ . '/../connect_database.php';
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $product_id = $_REQUEST['product_id'];
        $customer_id = $_REQUEST['customer_id'];
        $quantity = 0;
        $connect = connectLocalDb();
        $sql = "
        INSERT INTO cart_order(product_id,customer_id,quantity,is_sale_order)
        VALUES($product_id,$customer_id,$quantity,0)";
        mysqli_query($connect,$sql);
    }
    header("Location: shopping_cart_template.php");
?>