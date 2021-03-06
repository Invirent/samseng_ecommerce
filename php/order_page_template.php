<?php
    require __DIR__ . '/order_page.php';
    $product_id = $_GET['product_id'];
    $query = queryTable($product_id);
    $connect = connectLocalDb();

    $username = False;
    $user_id = False;

    if (isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $search_user = searchCurrentUser($username);
        $user_query = mysqli_query($connect,$search_user);
        $user_id = 0;
        foreach ($user_query as $user){
            $user_id = $user['user_id'];
            break;
        }
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Order Page</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        .background-samsung {
            background-color: rgb(240, 210, 45);
        }

        .main-container{
		    width: 100%;
		    height: 100%;
		}
        .product-container{
            width: 100%;
            height: 100%;
            padding-bottom: 50px;
        }

        .product-image {
            padding-top: 25px;
            padding-left: 50px;
            padding-right: 50px;
            padding-bottom: 10px;
            float: left;
            height: 60%;
            width: 55%;
        }

        .product-detail {
            padding-top: 30px;
            padding-bottom: 50px;
        }

        .carousel {
            max-width: 100%;
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

form .btn:hover .inner{
  left: 0;
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
    margin-right: 500px;
}
.clear{
    clear:both;
}
.card-img-top{
    height:550px;
    max-width:100%;
    border-radius: 15px;
}
.desc{
    display: flex;
    flex-wrap: wrap;
}
input[type=submit]{
    background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8e4, #9f01ea);
    border: 6px solid black;
    color: white;
    text-align: center;
    font-weight: bold;
    display: inline-block;
    font-size: 26px;
    border-radius: 15px;
    transition: all 0.4s;
    width: 10%;
}

.buy-now{
    background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8e4, #9f01ea);
    border: 6px solid black;
    color: white;
    text-align: center;
    font-weight: bold;
    display: inline-block;
    font-size: 26px;
    border-radius: 15px;
    transition: all 0.4s;
    width: 10%;
}
.x{
    font-size:15px;
    color: black;
    text-decoration: none;
    word-break: break-word;
}
@media (max-width: 991px){
    .x{
    font-size:10px;
    text-align:justify;
    word-break: break-all;
    }
    
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
                if (!isset($_SESSION['user_id'])) {
                    $login = "<a href='html/eric/registrasi.php' style='margin: 1.25em; text-decoration: none; color: black ;'>Registrasi</a>
                    <a class='user-login btn btn-dark' id='user_login' type='button' href='html/eric/login.php'>Login</a>";
                }else{
                    $login = "<a href='../php/profile_user.php'><i class='fa fa-user-circle-o'></i></a>";
                }
                echo $login;
            ?> 
        </div>
    </nav>

    <div class='main-container'>
        <div class='product-container'>
            <?php
                if ((!isset($_GET['edit'])|| $_GET['edit']!= 1)) {
                    $product_name = $query[0]['product_name'];
                    $like_count = $query [0]['like_count'];
                    $product_price = $query[0]['product_price'];
                    $product_description = $query[0]['product_description'];
                    $product_id = $query[0]['product_id'];
                    $img_path = $query[0]['image_path'];
                    $product_sold = $query[0]['product_sold'];
                    $product_rate = $query[0]['product_rate'];
                    $total_ulasan = $query[0]['total_ulasan'];
                    
                    $buy_button = "<a class='buy-now' href='../html/eric/login.php'>Buy Now</a>";

                    if ($user_id != False){
                        $buy_button = "<input type='submit' name='submit' value='Buy'>";
                    }

                    $html = "
                    <div class='product-image'>
                    <img src='../static/img/$img_path' class='card-img-top' alt='...'>
                    </div>
                    <div class='product-detail'>                                            
                    <h1>$product_name</h1>
                    <b style='color: grey;'>Disukai oleh $like_count+ ??? Terjual $product_sold+ ??? ???$product_rate ($total_ulasan Ulasan)</b> 
                    <br><b style='font-size: xx-large;'>Rp. $product_price</b></br>
                    <a class='x'>$product_description</a>
                    <hr>
                    <form action='add_to_cart.php' method='get' name='add_to_cart'>
                    <input type='hidden' name='product_id' value='$product_id'>
                    <input type='hidden' name='customer_id' value='$user_id'>
                    $buy_button
                    </form>
                    <br>
					<br>
                    <br>
                    <br>
                    <br>
                    <br>
                    </div>
                    ";
                    echo $html;
                }else{
                    $product_name = $query[0]['product_name'];
                    $like_count = $query [0]['like_count'];
                    $product_price = $query[0]['product_price'];
                    $product_description = $query[0]['product_description'];
                    $product_category = $query[0]['category_id'];
                    $product_id = $query[0]['product_id'];
                    $img_path = $query[0]['image_path'];
                    $product_sold = $query[0]['product_sold'];
                    $product_rate = $query[0]['product_rate'];
                    $total_ulasan = $query[0]['total_ulasan'];

                    $category_query = "";
                    $sql = "SELECT 
                        product_category.id as category_id, 
                        product_category.name as category_name
                        FROM product_category";
                    $connect = connectLocalDb();
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['category_id'] == $product_category) {
                            $category_query .="<option value='".$row['category_id']."' selected>
                            ".$row['category_name']."
                            </option>";
                        }else{
                            $category_query .="<option value='".$row['category_id']."'>".$row['category_name']."</option>";
                        }
                    }

                    $html = "
                    <form action='edit_product.php' method='POST' enctype='multipart/form-data' name='edit_product'>
                    <table class='table'>
                    <tr>
                        <th class='border w-25'>Image <br/>
                        *(Hanya Masukan Apabila ingin mengganti gambar)
                        </th>
                        <td class='border'>
                            <input class='form-control' type='file' name='product_image'>
                        </td>
                    </tr>
                    <tr>
                        <th class='border w-25'>Product Name</th>
                        <td class='border'>
                            <input class='form-control' type='text' name='product_name' value='$product_name' required>
                        </td>
                    </tr>
                    <tr>
                        <th class='border w-25'>Product Category</th>
                        <td class='border'>
                            <select name='product_category' class='form-width' required>
                            $category_query
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class='border w-25'>Product Price</th>
                        <td class='border'>
                            Rp. <input type='integer' name='product_price' value='$product_price' required>
                        </td>
                    </tr>
                    <tr>
                        <th class='border w-25'>Product Description</th>
                        <td class='border'>
                            <textarea name='product_description' style='width: 100%;' required>$product_description</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th class='border w-25'>
                        <input type='hidden' name='product_id' value='$product_id'>
                        </th>
                        <td class='border'>
                            <input type='submit' name='submit' value='Save'>
                        </td>
                    </tr>
                    </form>
                    <br>
					<br>
                    <br>
                    <br>
                    <br>
                    <br>
                    </table>
                    </div>
                    ";
                    echo $html;
                }
            ?>
        </div> 
    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="..//jquery.mycart.js"></script>

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