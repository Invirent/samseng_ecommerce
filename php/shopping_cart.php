<?php
    require __DIR__ . '/../connect_database.php';
    function queryCart($user_id,$link){
        $sql = "
        SELECT
            cart.product_id as product_id,
            product.name as product_name,
            cart.customer_id as customer_id,
            customer.name as customer_name,
            cart.quantity as quantity
        FROM cart_order cart
        LEFT JOIN product_template product ON cart.product_id = product.id
        LEFT JOIN user_login customer ON cart.customer_id = customer.id
        WHERE cart.customer_id = $user_id
        ";
        $result = mysqli_query($link,$sql);
        return $result;
    }

    $user_id = 2;

    $connect = connectLocalDb();

    $query = queryCart($user_id,$connect);

    while ($row = mysqli_fetch_array($query)){
        print_r($row);
    }
    
?>