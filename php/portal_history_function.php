<?php
    require __DIR__ . '/../connect_database.php';
    function queryHistoryPortal($user_id){
        $condition = "WHERE customer_id = $user_id";
        $sql = "
            SELECT
                product_template.id as product_id,
                sale_order.id as order_id,
                product_template.name as product_name,
                product_template.product_price as product_price,
                sale_order.order_qty as quantity,
                sale_order.order_date as order_date,
                sale_order.total_price as total_price,
                product_template.image_path as image_path
            FROM sale_order
            LEFT JOIN product_template ON sale_order.product_id = product_template.id
            $condition
            ORDER BY sale_order.order_date DESC, product_template.name ASC
        ";
        $connect = connectLocalDb();
        $result = mysqli_query($connect,$sql);
        return $result;
    }
?>