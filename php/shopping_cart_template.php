<?php 
    require __DIR__ . '/shopping_cart.php';

    session_start();

    if (isset($_GET['remove'])){
        $remove_id = $_GET['remove'];
        unlinkData('cart_order', $remove_id);
        header('Location: shopping_cart_template.php');
    }

    function removeCart($id){
        $model = "cart_order";
        unlinkData($model,$id);
        header("Location: shopping_cart_template.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../static/css/important.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/font-awesome.css">
    <script src="../static/js/shopping_cart.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Home</title>
    <style>
        .cart-image{
            max-height: 160px;
            max-width: 160px;
        }
        .background-samsung{
            background-color: rgb(240, 210, 45);
        }
        .table-form{
            width: 100%;
        }
        .product-data{
            width: 40%;
        }
        .submit-right{
            margin-left: 30px;
            text-align: right;
        }
    </style>
    <script>
        function removeCart(id){
            var result = confirm("Are you sure you want to remove this item?");
            if(result){
                window.location.href = "shopping_cart_template.php?remove=" + id;
            }
        }
    </script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light background-samsung">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img src="../static/img/samsung_logo.png" class="website-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_content" aria-controls="navbar_content" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar_content">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../php/product_listing.php"><i class="fa fa-product-listing"></i>Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shopping_cart_template.php"><i class="fa fa-shopping-cart"></i>Cart</a>
                    </li>
                </ul>
            </div>
            
            <?php
                if (!isset($_SESSION['username'])) {
                    $login = "<a href='html/eric/registrasi.php' style='margin: 1.25em; text-decoration: none; color: black ;'>Registrasi</a>
                    <a class='user-login btn btn-dark' id='user_login' type='button' href='html/eric/login.php'>Login</a>";
                }else{
                    $login = "<a href='profile_user.php'><i class='fa fa-user-circle-o'></i></a>";
                }
                echo $login;
            ?>
        </div>
    </nav>

<?php
    
    
    $query = queryTable();
    $looping_tr = "";
    $number = 0;
    foreach ($query as $row){
        $id = $row['cart_id'];
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $customer_id = $row['customer_id'];
        $customer_name = $row['customer_name'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        $image_path = $row['image_path'];
        $total = $price * $quantity;
        if (file_exists($row['image_path'])){
            $image_path = "../static/img/no_img_default.png";
        }
        
        $looping_tr .= "
            <tr>
                <td class='border product-data'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col'>
                                <img src='../static/img/$image_path' 
                                class='cart-image' alt='$product_name'/>
                            </div>
                            <div class='col'>
                                <span>$product_name</span>
                            </div>
                        </div>
                    </div>
                </td>
                <td class='border text-center'>
                    Rp. <input type='text' id='price_$number' name='price_$number' value='$price' readonly/>
                </td>
                <td class='border text-center'>
                    <input type='hidden' id='id_$number' name='id_$number' value='$id'/>
                    <input type='number' id='quantity_$number' name='quantity_$number' value='$quantity' onChange='calc()'/>
                </td>
                <td class='border text-center'>
                    Rp. <input type='text' id='total_$number' name='total_$number' value='$total' readonly/>
                </td>
                <td class='border text-center'>
                    <p type='object' onclick='removeCart($id)'>
                        <i class='fa fa-trash' aria-hidden='true'></i>
                    </p>
                </td>
            </tr>
        ";
        $number += 1;
    }

    $html = "
        <div class='form-container'>
            <h3>
                Shopping Cart
            </h3>
            <form action='redirect_to_payment.php'
                method='GET' id='shopping_cart'>
                <table class='table-form'>
                    <tr>
                        <th class='border product-data'>
                            Product
                        </th>
                        <th class='border text-center'>
                            Price
                        </th>
                        <th class='border text-center'>
                            Quantity
                        </th>
                        <th class='border text-center' colspan='2'>
                            Total
                        </th>
                    </tr>
                    $looping_tr
                    <tr>
                        <td class='input_label' colspan='3'>
                            <input type='hidden' name='total_data' value='$number'
                        </td>
                        
                        <td class='submit-right'>
                            <input type='submit' name='submit' value='Submit'/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    "; 
    echo $html;
?>

    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col" id="company_logo_footer">
                    <a class="navbar-brand" href="html/carlos/home.html">
                        <img src="../static/img/samsung_logo.png" class="website-logo">
                    </a>
                    <p>Samseng The Way of Life</p>
                </div>
                <div class="col" id="information_footer">
                    <div class="row">
                        <h4>Hyperlink</h4>
                        <ul>
                            <li>
                                <a href="#" class="footer-link">About Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>