<?php
    // require __DIR__ . '/../connect_database.php';
    require __DIR__ . '/order_page.php';
    // include '../html/order_page.html';
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Order Page</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        .background-samsung {
            background-color: rgb(240, 210, 45);
        }
        
        .carousel {
            width: 60%;
            height: 10%;
            float: left;
        }
        .carousel-inner {
            padding-top: 10px;
            padding-left: 20px;
            padding-bottom: 25px;
            width: 860px;
            height: 480px;
            transition: opacity .6s ease;
        }

        .carousel-control-prev {
            height: 75%;
        }

        .carousel-control-next {
            padding-right: 10px;
            height: 75%;
        }

        .product-detail {
            padding-bottom: 10px;
            width: 500px;
            height: 500px;
        }

        .product-container {
            padding-top: 15px;
            padding-left: 1080px;
        }

        .main-container {
		    width: 1460px;
		}
        *{
            margin: 0;
            padding: 0;
            outline: none;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

.show-btn{
  background: #fff;
  padding: 10px 20px;
  font-size: 20px;
  font-weight: 500;
  color: #3498db;
  cursor: pointer;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}
.show-btn, .container{
  position: absolute;
  top: 55%;
  left: 60%;
  transform: translate(-50%, -50%);
}

input[type="checkbox"]{
  display: none;
}
.container{
  display: none;
  background: #fff;
  width: 410px;
  padding: 30px;
  box-shadow: 0 0 8px rgba(0,0,0,0.1);
}
#show:checked ~ .container{
  display: block;
}
.container .close-btn{
  position: absolute;
  right: 20px;
  top: 15px;
  font-size: 18px;
  cursor: pointer;
}
.container .close-btn:hover{
  color: #3498db;
}
.container .text{
  font-size: 35px;
  font-weight: 600;
  text-align: center;
}
.container form{
  margin-top: -20px;
}
.container form .data{
  height: 45px;
  width: 100%;
  margin: 40px 0;
}
form .data label{
  font-size: 18px;
}
form .data input{
  height: 100%;
  width: 100%;
  padding-left: 10px;
  font-size: 17px;
  border: 1px solid silver;
}
form .data input:focus{
  border-color: #3498db;
  border-bottom-width: 2px;
}
form .btn{
  margin: 30px 0;
  height: 45px;
  width: 100%;
  position: relative;
  overflow: hidden;
}
form .btn .inner{
  height: 100%;
  width: 300%;
  position: absolute;
  left: -100%;
  z-index: -1;
  background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8e4, #9f01ea);
  transition: all 0.4s;
}
form .btn:hover .inner{
  left: 0;
}
form .btn button{
  height: 100%;
  width: 100%;
  background: none;
  border: none;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 1px;
  cursor: pointer;

}

.wrapper{
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}

.wrapper span{
    width: 100%;
    text-align: center;
    font-size: 50px;
    font-weight: 600;
}

.wrapper span.num{
    font-size: 45px;
    border-right: 2px solid rgba(0,0,0,0.2);
    border-left: 2px solid rgba(0,0,0,0.2);
}
.btn-danger.my-cart-btn{
    float: right;
    margin-right: 200px;
    margin-top:103px;
}
.clear{
    clear:both;
}        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top)
        @media (max-width: 800px) {
            .row {
                flex-direction: column-reverse;
            }
            
        } */
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
                        <a class="nav-link" href="product_listing.php"><i class="fa fa-product-listing"></i>Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="php/shopping_cart.php"><i class="fa fa-shopping-cart"></i>Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php"><i class="fa fa-checkout"></i>Checkout</a>
                    </li>
                </ul>
            </div>
            
            <?php
                if (!isset($_SESSION['user_id'])) {
                    $login = "<a href='html/eric/registrasi.php' style='margin: 1.25em; text-decoration: none; color: black ;'>Registrasi</a>
                    <a class='user-login btn btn-dark' id='user_login' type='button' href='html/eric/login.php'>Login</a>";
                }else{
                    $login = "<a href='../html/eric/logout.php'><i class='fa fa-user-circle-o'></i></a>";
                }
                echo $login;

                
            ?> 
        </div>
    </nav>

<?php
    $account_name = $_SESSION['username'];
    $account_id = searchCurrentUser($account_name);
    $query = queryTable($account_id);
    $looping_tr = "";
    $number = 0;
    foreach ($query as $row) {
        // $id = $row['order_id'];
        // $user_id = $row['user_id'];
        $product_id = $row ['product_id'];
        $product_name = $row ['product_name'];
        $product_price = $row ['product_price'];
        $category_id = $row ['category_id'];
        $uom_id = $row ['uom_id'];
        $product_description = $row ['product_description'];
        $image_path = $row ['image_path'];
        $like_count = $row ['like_count'];
        // if (file-exists($row['image_path'])) {
        //     $image_path = "";
        // }

        $looping_tr .= "
            <tr>
                <td class='border product-data'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col'>
                                <img src='$image_path'
                                class='product-image' alt='$product_name'/>
                            </div>
                            <div class='col'>
                                <span>$product_name</span>
                            </div>
                        </div>
                    </div>
                </td>
                
        ";

    }
?>


    <div>
            <div class='main-container'>
                <div id='carouselExampleIndicators' class='carousel slide' data-bs-ride='carousel'>
                    <div class='carousel-indicators'>
                        <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>
                        <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='1' aria-label='Slide 2'></button>
                        <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='2' aria-label='Slide 3'></button>
                    </div>
                    <div class="carousel-inner">
                        <div class='carousel-item active'>
                            <img src='../static/img/Samsung A53 5G.png' class='d-block w-100' alt='...'>
                        </div>
                        <div class='carousel-item'>
                            <img src='../static/img/Samsung A53 two.jpg' class='d-block w-100' alt='...'>
                        </div>
                        <div class='carousel-item'>
                            <img src='../static/img/Samsung A53 three.jpg' class='d-block w-100' alt='...'>
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

                <div class="product-container">
                    <div class="product-detail">

                        <h1> <?php 
                        echo $product_name;
                    ?></h1>
                    <b style='color: grey;'>Disukai <?php 
                        echo $like_count;
                    ?></b>
                        <br><b style='font-size: xx-large;'>Rp <?php 
                        echo $product_price;
                    ?></b>
                        <br><a><?php 
                        echo $product_description;
                    ?></a>
                        <!-- <br><br><b>Garansi Resmi Samsung Indonesia</b>
                        <br><a>Processor: Exynos 1280</a>
                        <br><a>Display: Super AMOLED, 120Hz, 800 nits (HBM)</a>
                        <br><a>Main Camera: 64 MP, f/1.8, 26mm (wide), 1/1.7X, 0.8µm, PDAF, OIS</a>
                        <br><a>Selfie Camera: 32 MP, f/2.2, 26mm (wide), 1/2.8, 0.8µm</a>
                        <br><a>RAM: 8GB</a>
                        <br><a>Internal Storage: 128GB</a>
                        <br><a>Network: 5G</a>
                        <br><a>Battery Capacity: 5.000mAh</a>
                        <br><a>Water Resistant: IP67 dust/water resistant (up to 1m for 30 mins)</a> -->
                        <hr>
                        <div class="center">
                            <input type="checkbox" id="show">
                            <label for="show" class="show-btn">Buy Now</label>
                            <div class="container">
                               <label for="show" class="close-btn fas fa-times" title="close"></label>
                               <div class="text">
                                  select quantity
                               </div>
                               <form action="#">
                                  <div class="data">
                                     <label>Stock: 200</label>
                                     <div class="wrapper">
                                     <span class="minus">-</span>
                                     <span class="num">01</span>
                                     <span class="plus">+</span>
                                    </div>
                                 <script>
                                     const plus = document.querySelector(".plus"),
                                     minus = document.querySelector(".minus"),
                                     num = document.querySelector(".num");

                                     let a = 1;
                                     plus.addEventListener("click", ()=>{
                                         a++;
                                         a = (a < 10) ? "0" + a : a;
                                         num.innerText = a;
                                         console.log("a");
                                        });

                                        minus.addEventListener("click", ()=>{
                                        if(a > 1){
                                         a--;
                                         a = (a < 10) ? "0" + a : a;
                                         num.innerText = a;
                                        }
                                        });   
                                 </script>
                                  </div>
                                  <div class="btn">
                                     <div class="inner"></div>
                                     <button type="submit">checkout</button>
                                  </div>
                               </form>
                            </div>
                         </div>
                         <button class="btn btn-danger my-cart-btn" data-id="3" data-name="Samsung A53 5G" data-category="1" data-price="6000000" data-quantity="1" data-image="../static/img/Samsung A53 5G.png"> Add to cart</button>
                        <br>
						<br>
                    </div>
                    <div class="col-md-10">
                    <div id="carouselExampleIndicators1" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators1">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                    <div class="carousel-inner1">
                        <div class="carousel-item active">
                            <img src="../static/img/AC.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../static/img/Promo_Gajian.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../static/img/Galaxy_A53.jpg" class="d-block w-100" alt="...">
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
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