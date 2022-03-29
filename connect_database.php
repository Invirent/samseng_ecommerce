<?php 
    function connectLocalDb(){
        #Ganti username dan password sesuai dengan sistem
        $servername = "localhost";
        $database = "samseng_ecommerce";
        $username = "root";
        $password = "";
        $link = mysqli_connect($servername, $username, $password, $database);

        if ($link->connect_error) {
            die("Connection failed: " . $link->connect_error);
        }
        else{
            return $link;
        }
    }
?>