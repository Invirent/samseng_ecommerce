<?php
    require __DIR__ . '/../connect_database.php';
    function getFormData() {
        $location = $_POST['location'];
        $html_id = $_POST['html_id'];
        $img_file = "../static/img/" . basename($_FILES["image_path"]['name']);
        $formArray = array(
            'location' => $location,
            'html_id' => $html_id,
            'img_url' => $img_file,
            'img_name' => basename($_FILES["image_path"]['name'])
        );
        return $formArray;
    }

    function checkSaveimage($img_url){
        $allowUpload = 1;
        $imageType = strtolower(pathinfo($img_url,PATHINFO_EXTENSION));
        
        $error_msg = "";
        
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image_path"]["tmp_name"]);
            if($check !== false) {
                $allowUpload = 1;
            } else {
                $allowUpload = 0;
                $error_msg .="Gambar yang anda upload bukan merupakan gambar, ";
                $error_msg .="Silahkan Upload Gambar yang benar.\n";
            }
        }
        
        if ($_FILES["image_path"]["size"] > 50000000) {
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
            if (move_uploaded_file($_FILES["image_path"]['tmp_name'], $img_url)) {
                return True;
            }
        }
    }

    function insertToDatabase($formArray){
        $connect = connectLocalDb();
        $sql = "INSERT INTO image_editor (
                image_path, 
                location, 
                html_id)
                VALUES (
                '$formArray[img_name]', 
                '$formArray[location]', 
                '$formArray[html_id]')";
        $result = mysqli_query($connect,$sql);
        if ($result){
            echo "<script>
                alert ('Data Berhasil Ditambahkan');
                window.location.href = 'admin_image_editor.php';
                </script>
                ";
        }
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $array_data = getFormData();
        $checking = checkSaveimage($array_data['img_url']);
        if ($checking == True){
            insertToDatabase($array_data);
        }
    }
?>