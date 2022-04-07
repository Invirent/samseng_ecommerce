<?php
<<<<<<< HEAD
    session_start();

    require __DIR__ . '/../connect_database.php';
    
    function queryProduct($user_id) {
        $sql = "
        SELECT
            user.id as user_id,
            order.id as order_id,
            order.product_id as product_id,
            order.product_name as product_name,
            order.product.price as product_price,
            category.id as category_id,
            uom.id as uom_id,
            product.description as product_description,
            image.path as image_path,
            like.count as like_count
        FROM order_order page
        LEFT JOIN product_template product ON order.product_id = product.id
        LEFT JOIN user_login customer ON order.product_name = product.name
        WHERE order.product_name = $user_id
        AND like.count = 0
        ";
    }

    function searchCurrentUser($username){
        $sql = "
            SELECT login.id as user_id
            FROM user_login login
            WHERE login.username = '$username'
            LIMIT 1
        ";
        return $sql;
    }

    
=======

    include '../html/order_page.html';
>>>>>>> e7091bf93dd89b9f72dc14e1fafff73d96a4fdb0

?>