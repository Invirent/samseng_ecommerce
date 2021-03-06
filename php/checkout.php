<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../html/eric/login.php');
}

?>
<html>
<style type="text/css">  

.table-width{
    width: 100%;
}

.background-samsung{
    background-color: rgb(240, 210, 45);
}
.row {
    display: -ms-flexbox; /* IE10 */
    display: flex;
    -ms-flex-wrap: wrap; /* IE10 */
    flex-wrap: wrap;
    margin: 0 -16px;
  }
  
  .col-25 {
    -ms-flex: 25%; /* IE10 */
    flex: 25%;
  }
  
  .col-50 {
    -ms-flex: 50%; /* IE10 */
    flex: 50%;
  }
  
  .col-75 {
    -ms-flex: 75%; /* IE10 */
    flex: 75%;
  }
  
  .col-25,
  .col-50,
  .col-75 {
    padding: 0 16px;
  }
  
  .container {
    background-color: #f2f2f2;
    padding: 5px 20px 15px 20px;
    border: 1px solid lightgrey;
    border-radius: 3px;
  }
  
  input[type=text] {
    width: 100%;
    margin-bottom: 20px;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 3px;
  }
  
  label {
    margin-bottom: 10px;
    display: block;
  }
  
  .icon-container {
    margin-bottom: 20px;
    padding: 7px 0;
    font-size: 24px;
  }
  
  .btn {
    background-color: #04AA6D;
    color: white;
    padding: 12px;
    margin: 10px 0;
    border: none;
    width: 100%;
    border-radius: 3px;
    cursor: pointer;
    font-size: 17px;
  }
  
  .btn:hover {
    background-color: #45a049;
  }
  
  span.price {
    float: right;
    color: grey;
  }
  
  .carousel {
    max-width: 100%;
  }
  
  @media (max-width: 800px) {
    .row {
      flex-direction: column-reverse;
    }
    .col-25 {
      margin-bottom: 20px;
    }
  }
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../static/css/important.css" rel="stylesheet">
    <link href="../static/css/carlos/home.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/font-awesome.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Product Listing</title>
</head>
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
    </div>
</nav>

<div class="container-fluid">
  <div class="title">
    <h1>Checkout</h1>
  </div>

  <form action='confirm_payment.php'
    method='GET' id='add_address'>
  <table class="table-width">
    <tr>
      <th class="border">Product</th>
      <th class="border">Price/Unit</th>
      <th class="border">Quantity</th>
      <th class="border">Total</th>
    </tr>

    <?php 
        require __DIR__ . '/checkout_data.php';
        $sale_order = getSaleOrder();
        $total_price = 0;
        foreach ($sale_order as $sale){
            $html ="
                <tr>
                    <td class='border'>
                        <p>".$sale['product_name']."</p>
                    </td>
                    <td class='border'>
                        <p>Rp. ".$sale['product_price']."</p>
                    </td>
                    <td class='border'>
                        <p>".$sale['order_qty']."</p>
                    </td>
                    <td class='border'>
                        <p>Rp. ".$sale['total_price']."</p>
                    </td>
                </tr>
            ";
            echo $html;
            $total_price += $sale['total_price'];
        }

    ?>

    <tr>
        <th class="border">
            Address : 
        </th>
        <td class="border" colspan="3">
            <input type="text" name="address" class="form-control" placeholder="Jln. Bhayangkara">
        </td>
    </tr>
    <tr>
        <th class="text-right" colspan="2">
            Metode Pembayaran :
        </th>
        <td>
            <div class="dropdown">
              <select class="form-control" name="payment_method">
                <option value="1">Samseng Pay</option>
                <option value="2">Cash On Delivery</option>
                <option value="3">Transfer Bank</option>
            </div>
        </td>
    </tr>
    <tr>
        <th class="text-right" colspan="4">
            <input type="submit" class="btn btn-primary" value="Confirm Payment">
        </th>
    </tr>
  </table>
</form>
    
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
