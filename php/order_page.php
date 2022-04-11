<?php
    session_start();

    require __DIR__ . '/../connect_database.php';
    
    function queryProduct($product_id) {
        $sql = "
        SELECT
            product_template.id as product_id,
            product_template.name as product_name,
            product_template.product_price as product_price,
            product_template.category_id as category_id,
            product_template.uom_id as uom_id,
            product_template.description as product_description,
            product_template.image_path as image_path,
            product_template.like_count as like_count,
            product_template.product_sold as product_sold,
            product_template.product_rate as product_rate,
            product_template.total_ulasan as total_ulasan
        FROM product_template
        WHERE product_template.id = $product_id
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

    function queryTable($product_id) {
        $connect = connectLocalDb();

        $username = $_SESSION['username'];
        $search_user = SearchCurrentUser($username);
        $user_query = mysqli_query($connect,$search_user);
        $user_id = 0;
        foreach ($user_query as $user) {
            $user_id = $user['user_id'];
            break;
        }
        $query = queryProduct($product_id);
        $product_order = [];
        $result = mysqli_query($connect,$query);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($product_order,$row);
        }
        return $product_order;
    }
    

    // include '../html/order_page.html';

?>