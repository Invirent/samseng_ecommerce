<?php
    require __DIR__ . '/../connect_database.php';
    $conn = mysqli_connect('localhost','20si2','uphmedan');
    include '../html/checkout.html';
    $Alamat = $_POST['address'];
    
    // var_dump($_POST);die();
    
    $query = "INSERT INTO sale_order (address) values (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s",$Alamat);

    
?>
