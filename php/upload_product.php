<?php
    require __DIR__ . '/../connect_database.php';
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
        header("Location: ../index.php");
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
    .table-width{
        width: 100%;
    }
    .form-width{
        width: 100%;
    }
    .text-right{
        margin-left: 70%;
    }
    .carousel {
        max-width: 100%;
    }
    </style>
</head>
<body>
    <!--navbar-->
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
    $upload="";
    if (!isset($_SESSION['username'])) {
        $login = "<a href='../html/eric/registrasi.php' style='margin: 1.25em; text-decoration: none; color: black ;'>Registrasi</a>
        <a class='user-login btn btn-dark' id='user_login' type='button' href='../html/eric/login.php'>Login</a>";
    }else{
        $login = "<a href='profile_user.php'><i class='fa fa-user-circle-o'></i></a>";
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

    <div clas="form-width">
        <h1>Upload Product</h1>
        <form action="push_product.php" method="POST" enctype="multipart/form-data">
        <table class="table-width">
            <tr>
                <th class="border">Product Name</th>
                <td class="border">
                    <input type="text" class="form-width"
                    name="product_name" placeholder=".... Samseng" require>
                </td>
            </tr>
            <tr>
                <th class="border">Product Description</th>
                <td class="border">
                    <textarea name="product_desc" class="form-width"
                    placeholder=".... Samseng"
                    colspan="6" rowspan="10"></textarea>
                </td>
            </tr>
            <tr>
                <th class="border">Product Price</th>
                <td class="border">
                    <input type="number" class="form-width" name="product_price" value="0">
                </td>
            </tr>
            <tr>
                <th class="border">Category</th>
                <td class="border">
                    <select name="product_category" class="form-width" require>
                    <?php
                        $sql = "SELECT 
                            product_category.id as category_id, 
                            product_category.name as category_name
                         FROM product_category";
                        $connect = connectLocalDb();
                        $result = mysqli_query($connect, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
                        }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="border">Upload Image</th>
                <td class="border">
                    <input type="file" name="product_image">
                </td>
            </tr>
            <tr>
                <th class="border"></th>
                <th class="border">
                    <button class="text-right" type="submit" name="submit" value="Uploads">Upload</button>
                </th>
            </tr>
        </table>
        </form>
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