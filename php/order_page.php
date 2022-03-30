<?php
    require __DIR__ . '/../connect_database.php';
    function queryCart($user_id,$link){
        $sql = "

        ";
        $result = mysqli_query($link,$sql);
        return $result;
    }
?>