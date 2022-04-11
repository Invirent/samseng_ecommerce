<?php
    require __DIR__ . '/../connect_database.php';
    function getFormData() {
        $product_name = $_POST['product_name'];
        $product_desc = $_POST['product_desc'];
        $product_price = $_POST['product_price'];
        $product_category = $_POST['product_category'];
        $img_file = "../static/img/" . basename($_FILES["product_image"]['name']);
        $formArray = array(
            'product_name' => $product_name,
            'product_desc' => $product_desc,
            'product_price' => $product_price,
            'category_id' => $product_category,
            'img_url' => $img_file,
            'img_name' => $_FILES["product_image"]['name']
        );
        return $formArray;
    }

    function checkSaveImage($img_url){
        $allowUpload = 1;
        $imageType = strtolower(pathinfo($img_url,PATHINFO_EXTENSION));
        
        $error_msg = "";
        
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["product_image"]["tmp_name"]);
            if($check !== false) {
                $allowUpload = 1;
            } else {
                $allowUpload = 0;
                $error_msg .="Gambar yang anda upload bukan merupakan gambar, ";
                $error_msg .="Silahkan Upload Gambar yang benar.\n";
            }
        }
        
        if ($_FILES["product_image"]["size"] > 50000000) {
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
            if (move_uploaded_file($_FILES["product_image"]['tmp_name'], $img_url)) {
                return True;
            }
        }
    }

    function insertToDatabase($formArray){
        $connect = connectLocalDb();
        $sql = "INSERT INTO product_template (
                name, 
                description, 
                product_price, 
                category_id,
                uom_id,
                image_path)
                VALUES (
                '$formArray[product_name]', 
                '$formArray[product_desc]', 
                '$formArray[product_price]', 
                '$formArray[category_id]', 
                '1',
                '$formArray[img_name]')";
        $result = mysqli_query($connect,$sql);
        if ($result){
            echo "<script>
                alert ('Data Berhasil Ditambahkan');
                window.location.href = 'upload_product.php';
                </script>
                ";
        }
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $array_data = getFormData();
        $checking = checkSaveImage($array_data['img_url']);
        if ($checking == True){
            insertToDatabase($array_data);
        }
    }
?>