<?php 
    require __DIR__ . '/portal_history_function.php';

    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: ../html/eric/login.php');
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

        .carousel {
            max-width: 100%;
        }
        .fa-trash{
            color: red;
            font-size: 25px;
        }
        input[type=submit]{
    background: -webkit-linear-gradient(left, #c68e17, #d4a017, #E8A317, #FFE87C);
    border: 6px solid orange;
    color: white;
    height: 8%;
    text-align: center;
    font-weight: bold;
    display: inline-block;
    font-size: 17px;
    border-radius: 10px;
}
    </style>
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
                    <?php
                        if (isset($_SESSION['user_id'])){
                            echo "<li class='nav-item'>
                            <a class='nav-link' href='shopping_cart_template.php'><i class='fa fa-shopping-cart'></i>Cart</a>
                            </li>
                            <li class='nav-item'>
                            <a class='nav-link' href='portal_history.php'><i class='fa fa-history'></i>History</a>
                            </li>";
                        }
                    ?>
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
    
    $user_id = $_SESSION['user_id'];
    $query = queryHistoryPortal($user_id);
    $looping_tr = "";
    $number = 0;
    foreach ($query as $row){
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $product_price = $row['product_price'];
        $quantity = $row['quantity'];
        $image_path = $row['image_path'];
        $order_date = $row['order_date'];
        $total_price = $row['total_price'];
        
        $looping_tr .= "
        <a href='order_page_template.php?product_id=$product_id'>
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
                    $order_date
                </td>
                <td class='border text-center'>
                    Rp. $product_price
                </td>
                <td class='border text-center'>
                    $quantity
                </td>
                <td class='border text-center'>
                    Rp. $total_price
                </td>
            </tr>
        </a>
        
        ";
        $number += 1;
    }

    $html = "
        <div class='form-container'>
            <h3>
                History
            </h3>
            <table class='table-form'>
                <tr>
                    <th class='border product-data' style='text-align:center;'>
                        Product
                    </th>
                    <th class='border text-center'>
                        Date
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
            </table>
        </div>
    "; 
    echo $html;
?>

    <div>
        <br>
        <div id='carouselExampleIndicators' class='carousel slide' data-bs-ride='carousel'>
            <div class='carousel-indicators'>
                <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>
                <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='1' aria-label='Slide 2'></button>
                <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='2' aria-label='Slide 3'></button>
            </div>
            <div class="carousel-inner">
                        <div class='carousel-item active'>
                            <img src='../static/img/carousel-ramadhan.png' class='d-block w-100' alt='...'>
                        </div>
                        <div class='carousel-item'>
                            <img src='../static/img/carousel-ramadhan3.png' class='d-block w-100' alt='...'>
                        </div>
                        <div class='carousel-item'>
                            <img src='../static/img/carousel-ramadhan2.png' class='d-block w-100' alt='...'>
                        </div>
                    </div>
                    <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Previous</span>
                    </button>
                    <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Next</span>
                    </button>
                </div>
					</div>
    </div>

    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col" id="company_logo_footer">
                    <a class="navbar-brand" href="html/carlos/home.html">
                        <img src="../static/img/samsung_logo.png" class="website-logo">
                    </a>
                    <p>Samseng The Way of Life</p>
                </div>
                
            </div>
        </div>
    </footer>
</body>
</html>