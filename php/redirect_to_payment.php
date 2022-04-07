<?php
    require __DIR__ . '/../connect_database.php';
    session_start();
    function editCart($list){
        $connect = connectLocalDb();
        foreach ($list as $data){
            $id = $data["id"];
            $quantity = $data["quantity"];

            $sql = "UPDATE cart_order 
                SET quantity = $quantity,
                is_sale_order = 1 
                WHERE id = $id";
            mysqli_query($connect,$sql);
        }
    }

    function getCartData($list){
        $connect = connectLocalDb();
        $cartData = [];
        foreach ($list as $data){
            $id = $data["id"];
            $sql = "
                SELECT
                    product_template.id as product_id,
                    product_template.name as product_name,
                    product_template.product_price as price,
                    cart_order.customer_id as customer_id,
                    cart_order.quantity as quantity
                FROM cart_order
                LEFT JOIN product_template ON
                cart_order.product_id = product_template.id
                WHERE cart_order.id = $id
            ";
            $result = mysqli_query($connect,$sql);
            while ($row = mysqli_fetch_assoc($result)){
                $result = $row;
                break;
            }
            $result['total_amount'] = $data['total'];
            array_push($cartData,$result);
        }
        return $cartData;
    }

    function prepareSaleData($cart_order){
        $sale =  [];
        foreach ($cart_order as $cart){
            $array = array(
                "name" => "'SO00001'",
                "product_id" => $cart['product_id'],
                "customer_id" => $cart['customer_id'],
                "order_qty" => $cart['quantity'],
                "total_price" => $cart['total_amount'],
            );
            array_push($sale,$array);
        }
        return $sale;
    }

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $number = 0;
        $list = [];
        $total_data = $_REQUEST['total_data'];
        $total_amount = 0;
        while ($number < $total_data){
            $id = $_REQUEST["id_$number"];
            $quantity = $_REQUEST["quantity_$number"];
            $subtotal_amount = $_REQUEST["total_$number"];
            $value = array(
                "id" => $id,
                'quantity' => $quantity,
                "total" => $subtotal_amount,
            );
            array_push($list,$value);
            $number += 1;
            $total_amount += $subtotal_amount;
        };
        if (count($list) > 0){
            $cart_condition = editCart($list);
            $cart_data = getCartData($list);
            $sale_order_array = prepareSaleData($cart_data);
            $connect = connectLocalDb();
            $model = "sale_order";
            $ids = [];
            foreach ($sale_order_array as $array){
                $result = insertData($model,$array,$connect);
                array_push($ids, $result);
            }
            $_SESSION['current_ids'] = $ids;
        }

        if (count($_SESSION['current_ids']) > 0){
            header("Location: checkout.php");
        }

    }
?>