<?php
    require __DIR__ . '/../connect_database.php';

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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $img_condition = "";
        if (!empty($_FILES['product_image'])){
            $img_condition = "";
        }
        else{
            $checking = checkSaveImage("../static/img/" . basename($_FILES["product_image"]['name']));
            if ($checking == True){
                $product_image = basename($_FILES["product_image"]['name']);
                $img_condition = " image_path = '$product_image',";
            }
        }
        $conn = connectLocalDb();
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_category = $_POST['product_category'];
        $product_description = $_POST['product_description'];
        $product_like_count = $_POST['product_like_count'];
        $product_sold = $_POST['product_sold'];
        $product_rate = $_POST['product_rate'];
        $product_total_ulasan = $_POST['product_total_ulasan'];

        $sql = "
            UPDATE product_template
            SET
                name = '$product_name',
                product_price = '$product_price',
                category_id = '$product_category',
                uom_id = '$product_uom',
                description = '$product_description',
                $img_condition
                like_count = '$product_like_count',
                product_sold = '$product_sold',
                product_rate = '$product_rate',
                total_ulasan = '$product_total_ulasan'
            WHERE id = '$product_id'
        ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: admin_page_product.php");
        }
    }

?>