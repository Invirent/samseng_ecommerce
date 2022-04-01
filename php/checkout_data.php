<?php
    session_start();
    require __DIR__ . '/../connect_database.php';
    $connect = connectLocalDb();
    $Alamat = $_POST['address'];
    
    // var_dump($_POST);die();
    
    $query = "INSERT INTO sale_order (address) values (?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("s",$Alamat);
    if($stmt->execute()){
        echo "berhasil";
    } else {
        echo "data gagal di tambah" . $stmt->error;
    }
?>