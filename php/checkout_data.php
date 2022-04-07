<?php
    require __DIR__ . '/../connect_database.php';
    $connect = connectLocalDb();

    function getSaleIds(){
        $sale_ids = $_SESSION['current_ids'];
        return $sale_ids;
    }

    function getSaleOrder(){
        $sale_ids = getSaleIds();
        $connect = connectLocalDb();
        $model = "sale_order";
        $sale_orders = [];
        foreach($sale_ids as $sale_id){
            $query = "
                SELECT 
                sale_order.id as sale_id,
                sale_order.order_qty as order_qty,
                sale_order.total_price as total_price,
                product_template.name as product_name,
                product_template.id as product_id,
                product_template.product_price as product_price
                FROM $model
                LEFT JOIN product_template ON 
                sale_order.product_id = product_template.id
                WHERE sale_order.id = $sale_id
            ";
            $result = mysqli_query($connect,$query);
            $sale_order = mysqli_fetch_assoc($result);
            array_push($sale_orders,$sale_order);
        }
        return $sale_orders;
    }

    if (!isset($_SESSION['username'])) {
        header("Location: ../index.php");
    }
?>