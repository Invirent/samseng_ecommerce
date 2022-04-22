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
    <link href="../static/css/important.css" rel="stylesheet">
    <link href="../static/css/carlos/home.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Boogaloo&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
    .background-samsung{
        background-color: rgb(240, 210, 45);
    }

    .carousel {
        max-width: 100%;
    }

    h1 {
        text-align: center;
        color: white;
        font-family: 'Boogaloo', cursive;
    }

    h2 {
        text-align: center;
        color: yellow;
        font-family: 'Cormorant', serif;
    }

    h3 {
        text-align: center;
        color: #f78620;
        font-family: 'Cormorant', serif;
    }

    .thankyou-content {
        background-color: #101e3f;
        text-align: center;
    }
    </style>
    <title>Home</title>
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
                        <a class="nav-link" href="product_listing.php"><i class="fa fa-product-listing"></i>Shop</a>
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
                    $login = "<a href='../html/eric/registrasi.php' style='margin: 1.25em; text-decoration: none; color: black ;'>Registrasi</a>
                    <a class='user-login btn btn-dark' id='user_login' type='button' href='html/eric/login.php'>Login</a>";
                }else{
                    $login = "<a href='profile_user.php'><i class='fa fa-user-circle-o'></i></a>";
                }
                echo $login;
            ?>
        </div>
    </nav>
    
    <div class="thankyou-container">
        <div class="thankyou-content">
            <div>
            <img src='../static/img/Thankyou_bg flip.png' alt="..."">
                <h1>Purchase Success !!!</h1>
                <h2>Thank You For Your Purchase !</h2>
                <h3>We Appreciate Your </h3>
                <h3>Most Recent Purchase and Hope You</h3>
                <h2>ENJOY YOUR NEW ITEMS.</h2>
                <h1>SEE YOU NEXT TIME.</h1>
                <a href="../index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">EXPLORE MORE</a>
            <img src='../static/img/Thankyou_bg.png' alt="...">
            </div>
            
        </div>
    </div>

    <div>
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