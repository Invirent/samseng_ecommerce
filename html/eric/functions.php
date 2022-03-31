<?php
// koneksi ke database

$conn = mysqli_connect("localhost", "root", "", "samseng_ecommerce");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasi = mysqli_real_escape_string($conn, $data["konfirmasi"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user_login WHERE username ='$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username telah terdaftar!');
                window.location.href='../../index.php';
              </script>";
        return false;
    }

    //cek konfirmasi password
    if($password !== $konfirmasi){
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
              </script>";
        return false;
    }

    //enkripsi password

    $password = password_hash($password, PASSWORD_DEFAULT);
     

    //tambah user baru ke database
    mysqli_query($conn, "
    INSERT INTO user_login(username,password,access_right,name)
    VALUES('$username','$password','portal','$username')");

    return mysqli_affected_rows($conn);
}
?>