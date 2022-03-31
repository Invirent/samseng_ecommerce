<?php
    require __DIR__ . '/../connect_database.php';

    function queryCart($user_id){
        $sql = "
        SELECT
            cart.id as cart_id,
            cart.product_id as product_id,
            product.name as product_name,
            cart.customer_id as customer_id,
            customer.name as customer_name,
            cart.quantity as quantity,
            cart.is_sale_order as is_sale,
            product.product_price as price,
            product.image_path as image_path
        FROM cart_order cart
        LEFT JOIN product_template product ON cart.product_id = product.id
        LEFT JOIN user_login customer ON cart.customer_id = customer.id
        WHERE cart.customer_id = $user_id
        AND cart.is_sale_order = 0
        ";
        return $sql;
    }
    
    function queryTable(){
        $user_id = 2;
        $connect = connectLocalDb();
        $query = queryCart($user_id);
        $result = mysqli_query($connect,$query);
        return $result;
    }

?>