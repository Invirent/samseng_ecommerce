<?php
    require __DIR__ . '/../connect_database.php';

    function queryCart($condition){
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
        $condition
        AND cart.is_sale_order = 0
        ";
        return $sql;
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
    
    function queryTable(){
        $connect = connectLocalDb();

        $username = $_SESSION['username'];
        $search_user = searchCurrentUser($username);
        $user_query = mysqli_query($connect,$search_user);
        $user_id = 0;
        foreach ($user_query as $user){
            $user_id = $user['user_id'];
            break;
        }
        
        $condition = "WHERE cart.customer_id = $user_id";
        $query = queryCart($condition);

        $result = mysqli_query($connect,$query);
        return $result;
    }

?>