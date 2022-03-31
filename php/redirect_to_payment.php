<?php
    require __DIR__ . '/../connect_database.php';

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $number = 0;
        $list = [];
        $total_data = $_REQUEST['total_data'];
        while ($number < $total_data){
            $id = $_REQUEST["id_$number"];
            $quantity = $_REQUEST["quantity_$number"];
            $value = array(
                "id" => $id,
                'quantity' => $quantity
            );
            array_push($list,$value);
            $number += 1;
        };
        if (count($list) > 0){
            $array = array(
                "name" => "'SO00002'",
                "product_id"=> 1,
                "customer_id" => 2,
                "order_qty" => 1,
                "address" => "'Jln. XXX'"
            );
            $connect = connectLocalDb();
            $model = "sale_order";
            $result = insertData($model,$array,$connect);
            echo $result;
        }
    }
?>