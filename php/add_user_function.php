<?php
    require __DIR__ . '/../connect_database.php';
    $connect = connectLocalDb();
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $username = $_GET['username'];
        $password = $_GET['password'];
        $access_right = $_GET['access_right'];
        $name = $_GET['name'];
        $address = $_GET['address'];

        $enc_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "
        INSERT INTO user_login (
            username,
            password,
            access_right,
            name,
            address
        ) VALUES (
            '$username',
            '$enc_password',
            '$access_right',
            '$name',
            '$address'
        )
        ";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            echo "<script>
                alert ('Data Berhasil Ditambahkan');
                window.location.href = 'admin_page_user.php';
                </script>
                ";
        }
    }
?>