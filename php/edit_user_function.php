<?php
    require __DIR__ . '/../connect_database.php';
    $connect = connectLocalDb();
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $user_id = $_GET['user_id'];
        $username = $_GET['username'];
        $access_right = $_GET['access_right'];
        $name = $_GET['name'];
        $address = $_GET['address'];
        $sql = "
            UPDATE user_login 
            SET
                username = '$username',
                access_right = '$access_right',
                name = '$name',
                address = '$address'
            WHERE id = '$user_id'
        ";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            header("Location: admin_page_user.php");
        }
    }
?>