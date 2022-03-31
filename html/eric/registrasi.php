<?php
require 'functions.php';

if(isset($_POST["register"])){

    if(registrasi($_POST) > 0){
        echo "<script>
                alert('user baru berhasil ditambahkan!');
              </script>";
    } else{
        echo mysqli_error($conn);
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registasi</title>
    <style>
        body{
            background-image:url("../../static/img/sova.png");
        }
        div{
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            border: 5px solid black;
            background: white;
            padding: 2.5em;
        }
        label{
            display: block;
            font-weight: 500;
            margin-right: 2em;
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
        <h1>Halaman Registrasi</h1>

        <form action="" method="post">
            <ul>
                <li>
                    <label for="username">Username :</label>
                    <input type="text" name="username" id="username">
                </li>
                <li>                
                    <label for="email">Email :</label>
                    <input type="text" name="email" id="email">
                </li>
                <li>                
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password">
                </li>
                <li>
                    <label for="konfirmasi">Password Confirmation :</label>
                    <input type="password" name="konfirmasi" id="konfirmasi">
                </li>
                <li>
                    <button type="submit" name="register">Registrasi</button>
                </li>
            </ul>
        </form>
    </div>
</body>
</html>