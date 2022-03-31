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

    function insertData($model, $array, $database){
        $keyword = array_keys($array);
        
        $value_sql = "";
        $keyword_sql = "";
        foreach ($keyword as $key){
            if ($keyword_sql == ""){
                $keyword_sql .= "$key";
            }
            else{
                $keyword_sql .= ",$key";
            }

            $value = $array[$key];
            if ($value_sql == ""){
                $value_sql .= "$value";
            }
            else{
                $value_sql .= ",$value";
            }
        }
        $sql ="
            INSERT INTO $model ($keyword_sql)
            VALUES ($value_sql);
        ";
        $result = mysqli_query($database,$sql);
        return $result;
    }

?>