<?php
    require __DIR__ . '/../connect_database.php';
    session_start();

    if (isset($_GET['search'])) {
        $search = "WHERE product_template.name LIKE '%".$_GET['search']."%'";
    }else{
        $search = "";
    }

    function queryProductTemplate($search) {
        $connect = connectLocalDb();
        $sql = "
        SELECT  
            product_template.id as product_id,
            product_template.name as product_name,
            product_template.product_price as product_price,
            product_template.image_path as image_url,
            product_category.name as category_name
        FROM product_template
        LEFT JOIN product_category ON product_template.category_id = product_category.id
        $search";
        $result = mysqli_query($connect, $sql);
        $product_template = [];
        while($row = mysqli_fetch_assoc($result)) {
            array_push($product_template, $row);
        }
        return $product_template;
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
    <link href="../static/css/carlos/home.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/font-awesome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Product Listing</title>
    <style type="text/css">
        .background-samsung{
            background-color: rgb(240, 210, 45);
        }

        .carousel-inner {
            width: 100%;
            height : 540px;
        }

        .list-group-item {
            text-align: center;
        }

        .carousel-item {
            width: 100%;
        }

        .card {
            margin: 25px;
        }
        .card p {
            margin-top: -10px;
            margin-bottom: 1px;
        }

        .row .card:hover {
            box-shadow: 2px 2px 2px rgba(0,0,0,0.4);
            transform: scale(1.02);
        }
        form {
            background-color: orange;
            width: 300px;
            height: 44px;
            border-radius: 5px;
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        ::placeholder{
            color: orange;
            opacity: 0.7;
        }

        button{
            margin-left: 30px;
            background: yellow;
        }

    </style>
</head>
<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light background-samsung">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
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
                    <li class="nav-item">
                        <a class="nav-link" href="shopping_cart.php"><i class="fa fa-shopping-cart"></i>Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order_page_template.php"><i class="fa fa-order-page"></i>Order Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php"><i class="fa fa-checkout"></i>Checkout</a>
                    </li>
                    
                </ul>
            </div>
<?php
    $upload="";
    if (!isset($_SESSION['username'])) {
        $login = "<a href='../html/eric/registrasi.php' style='margin: 1.25em; text-decoration: none; color: black ;'>Registrasi</a>
        <a class='user-login btn btn-dark' id='user_login' type='button' href='../html/eric/login.php'>Login</a>";
    }else{
        $login = "<a href='../html/eric/logout.php'><i class='fa fa-user-circle-o'></i></a>";
        if (($_SESSION['role'] == 'admin')) {
            $upload = "<a href='upload_product.php'>
            <button>Upload Product</button></a>";
        }
    }
    echo $upload;
    echo $login;
?> 
        </div>
    </nav>
    
    <div class="row">
        <div class="col-md-2 bg-light">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-warning"><i class="fa fa-list"></i> KATEGORI PRODUK</li>
                <li class="list-group-item"><i class="fa fa-angle-right"></i> Smartphone</li>
                <li class="list-group-item"><i class="fa fa-angle-right"></i> Laptop</li>
                <li class="list-group-item"><i class="fa fa-angle-right"></i> Monitor</li>
                <li class="list-group-item"><i class="fa fa-angle-right"></i> TV</li>
                <li class="list-group-item"><i class="fa fa-angle-right"></i> AC</li>
                <li class="list-group-item"><i class="fa fa-angle-right"></i> Kulkas</li>
            </ul>
            <li class="nav-item">
                    <form id="form" method="GET" action="product_listing.php">
                    <input type="text" id="search" name="search"
                    placeholder="Search product.."
                     aria-label="Search through site content">
                     <button>
                    <input type="submit" value="Search"></button>
                    </form>
                    </li>
        </div>
        <div class="col-md-10">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="../static/img/AC.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="../static/img/Promo_Gajian.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="../static/img/Galaxy_A53.jpg" class="d-block w-100" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            <h4 class="text-center font-weight-bold">Produk - Produk Elektronik</h4>
            <div class="row mx-auto">
<?php
    $product_ids = queryProductTemplate($search);
    foreach($product_ids as $product_id) {
        $img_path = $product_id['image_url'];
        $product_name = $product_id['product_name'];
        $product_price = $product_id['product_price'];
        $product = $product_id['product_id'];
        $category_name = $product_id['category_name'];
        $html = "
        <div class='card mr-2 ml-2' style='width: 16rem;'>
            <a href='order_page_template.php?product_id=$product'>
            <img src='../static/img/$img_path' class='card-img-top' alt='...'>
            <div class='card-body bg-light'>
            <h5 class='card-title'>$product_name</h5>
            <p class='card-text'>$category_name</p>
            <i class='fa fa-star text-success'></i>
            <i class='fa fa-star text-success'></i>
            <i class='fa fa-star text-success'></i>
            <i class='fa fa-star-half text-success'></i>
            <i class='fa fa-star-o text-success'></i>
            <br>
            <a href='order_page_template.php?product_id=$product' 
            class='btn btn-primary'>Detail</a>
            <a href='order_page_template.php?product_id=$product' 
            class='btn btn-danger'>Rp. $product_price</a>
            </div>
            </a>
        </div>
        ";
        echo $html;
    }              
?>
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