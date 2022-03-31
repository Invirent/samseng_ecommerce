<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="static/css/important.css" rel="stylesheet">
    <link href="static/css/carlos/home.css" rel="stylesheet">
    <link rel="stylesheet" href="static/css/font-awesome.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
    .background-samsung{
        background-color: rgb(240, 210, 45);
    }
    </style>
    <title>Home</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light background-samsung">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="static/img/samsung_logo.png" class="website-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_content" aria-controls="navbar_content" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar_content">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="php/product_listing.php"><i class="fa fa-product-listing"></i>Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="php/shopping_cart_template.php"><i class="fa fa-shopping-cart"></i>Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="php/checkout.php"><i class="fa fa-checkout"></i>Checkout</a>
                    </li>
                </ul>
            </div>
            <?php
                if (!isset($_SESSION['username'])) {
                    $login = "<a href='html/eric/registrasi.php' style='margin: 1.25em; text-decoration: none; color: black ;'>Registrasi</a>
                    <a class='user-login btn btn-dark' id='user_login' type='button' href='html/eric/login.php'>Login</a>";
                }else{
                    $login = "<a href='html/eric/logout.php'><i class='fa fa-user-circle-o'></i></a>";
                }
                echo $login;
            ?>
        </div>
    </nav>

    <div class="container-fluid">
        <!-- Carousel Item -->
        <div id="carousel-container">
            <div id="carousel_inner" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carousel_inner" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Samsung Galaxy Z Fold"></button>
                  <button type="button" data-bs-target="#carousel_inner" data-bs-slide-to="1" aria-label="Holiday Gift"></button>
                  <button type="button" data-bs-target="#carousel_inner" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="static/img/home_samsung_img.png" class="d-block w-100" alt="Samsung Galaxy Z Fold">
                    <div class="carousel-caption carousel-right d-none d-md-block">
                        <h1 class="carousel-title">Galaxy Z Fold</h1>
                        <p>Free 6 Month Samsung Care+.</p>
                    </div>
                  </div> 
                  <div class="carousel-item">
                    <img src="static/img/home_holiday_gift.png" class="d-block w-100" alt="Holiday Gift">
                    <div class="carousel-caption carousel-middle carousel-right d-none d-md-block">
                        <h1 class="carousel-title">The Perfect Gift</h1>
                        <p>Get the perfect gift for family.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="static/img/home_tv.png" class="d-block w-100" alt="Samsung TV">
                    <div class="carousel-caption carousel-left carousel-right d-none d-md-block">
                        <h1 class="carousel-title">Big Screen Tv</h1>
                        <p>Get the perfect gift for family.</p>
                    </div>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel_inner" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel_inner" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Inner Content -->
        <div class="inner-content">
            <div id="first_content" class="container-fluid">
                <div class="row content">
                    <div class="col content-title inner-left">
                        <h2 class="inner-title">The Best Smartphone</h2>
                        <p>Try our newest samsung product to enjoy the best experience in life</p>
                    </div>
                    <div class="col">
                        <img src="static/img/home_first_image.png" class="content-img" alt="Samsung Phone">
                    </div>
                </div>
            </div>
            <div id="second_content" class="container-fluid">
                <div class="row content">
                    <div class="col">
                        <img src="static/img/home_second_image.jpg" class="content-img" alt="Samsung Phone">
                    </div>
                    <div class="col content-title inner-right">
                        <h2 class="inner-title">The World in technology</h2>
                        <p>Try our newest samsung product to enjoy the best experience in life</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col" id="company_logo_footer">
                    <a class="navbar-brand" href="html/carlos/home.html">
                        <img src="static/img/samsung_logo.png" class="website-logo">
                    </a>
                    <p>Samseng The Way of Life</p>
                </div>
                <div class="col" id="information_footer">
                    <div class="row">
                        <h4>Hyperlink</h4>
                        <ul>
                            
                            <li>
                                <a href="html/carlos/about_us.html" class="footer-link">About Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>