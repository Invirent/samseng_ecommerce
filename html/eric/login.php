<?php

session_start();
require 'functions.php';

if (isset($_SESSION['username'])) {
    header("Location: ../../index.php");
}

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn,"SELECT * FROM user_login WHERE username ='$username'");

    //cek username
    if(mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['access_right'];
            if ($_SESSION['role'] == 'admin') {
                header("Location: ../../php/admin_page_product.php");
                exit;
            } elseif ($_SESSION['role'] == 'portal') {
                header("Location: ../../index.php");
                exit;
            }
            header("Location: ../../index.php");
            exit;
        }
    }

    $error = true;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        body{
            background-image:url("../../static/img/football.png");
        }
        div{
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            border: 5px solid black;
            background: white;
        }
        li{
            list-style-type: none;
            margin: 2em;
        }
        li button{
            padding: 1.3em;
        }
    </style>
</head>
<body>
    <div>
        <h1>Halaman Login</h1>
        <?php if(isset($error)) : ?>
        <p style="color:red; font-style:italic;">Username/password salah</p>
        <?php endif; ?>
        <form action="" method="post">
            <ul>
                <li>
                    <label for="username">Username :</label>
                    <input type="text" name="username" id="username">
                </li>
                <li>
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password">
                </li>
                <li>
                    <button type="submit" name="login">Login</button>
                </li>
            </ul>
        </form>
    </div>
</body>
</html>