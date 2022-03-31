<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    //ambil data dari tiap elemen form
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    //query insert data
    $query = "INSERT INTO mahasiswa VALUES ('','$nama','$nrp','$email','$jurusan','$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}


function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = $data["email"];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasi = mysqli_real_escape_string($conn, $data["konfirmasi"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username ='$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username telah terdaftar!');
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
    mysqli_query($conn, "INSERT INTO users VALUES('','$username','$email','$password')");

    return mysqli_affected_rows($conn);
}
?>