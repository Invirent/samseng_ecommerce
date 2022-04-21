<?php
    require __DIR__ . '/../connect_database.php';

    function checkSaveImage($img_url){
        $allowUpload = 1;
        $imageType = strtolower(pathinfo($img_url,PATHINFO_EXTENSION));
        
        $error_msg = "";
        
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $allowUpload = 1;
            } else {
                $allowUpload = 0;
                $error_msg .="Gambar yang anda upload bukan merupakan gambar, ";
                $error_msg .="Silahkan Upload Gambar yang benar.\n";
            }
        }
        
        if ($_FILES["image"]["size"] > 50000000) {
            $allowUpload = 0;
            $error_msg .= "File yang Anda Upload Terlalu besar,";
            $error_msg .= "Maksimal berat dari foto adalah 50Mb.\n";
        }
        
        
        if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"
        && $imageType != "gif" ) {
            $allowUpload = 0;
            $error_msg .= "File yang boleh diupload harus PNG, JPG, JPEG, dan GIF,";
            $error_msg .= "Silahkan pilih gambar yang lain.\n";
        }

        if ($allowUpload == 1){
            $error_msg = False;
        }
        else{
            $error_msg = $error_msg;
        }
        if ($error_msg != False){
            echo "<script>
                alert ('$error_msg');
            </script>";
        }else{
            if (move_uploaded_file($_FILES["image"]['tmp_name'], $img_url)) {
                return True;
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $img_condition = "";
        if (!empty($_FILES['image'])){
            $img_condition = "";
        }
        else{
            $checking = checkSaveImage("../static/img/" . basename($_FILES["image"]['name']));
            if ($checking == True){
                $image = basename($_FILES["image"]['name']);
                $img_condition = " image_path = '$image',";
            }
        }
        $conn = connectLocalDb();
        $image_id = $_POST['image_id'];
        $location = $_POST['location'];
        $html_id = $_POST['html_id'];

        $sql = "
            UPDATE image_editor
            SET 
                location = '$location',
                html_id = '$html_id',
                $image_condition
            WHERE id = '$product_id'
        ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: admin_image_editor.php");
        }
    }

?>