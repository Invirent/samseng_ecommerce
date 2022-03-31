<?php
    require __DIR__ . '/../connect_database.php';
?>
<html>
<style type="text/css">  
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
  
  /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
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
    <link href="static/css/important.css" rel="stylesheet">
    <link href="static/css/carlos/home.css" rel="stylesheet">
    <link rel="stylesheet" href="static/css/font-awesome.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Product Listing</title>
</head>
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
                    <a class="nav-link" href="php/shopping_cart.php"><i class="fa fa-shopping-cart"></i>Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="row">
    <div class="col-85">
      <div class="container">
        <form action="/action_page.php">
  
          <div class="row">
            <div class="col-60">
              <h3>Billing Address</h3>
              <label for="fname"><i class="fa fa-user"></i> Full Name</label>
              <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
              <label for="email"><i class="fa fa-envelope"></i> Email</label>
              <input type="text" id="email" name="email" placeholder="john@example.com">
              <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
              <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
              <label for="city"><i class="fa fa-institution"></i> City</label>
              <input type="text" id="city" name="city" placeholder="New York">
  
              <div class="row">
                <div class="col-50">
                  <label for="state">State</label>
                  <input type="text" id="state" name="state" placeholder="NY">
                </div>
                <div class="col-50">
                  <label for="zip">Zip</label>
                  <input type="number" id="zip" name="zip" placeholder="10001">
                </div>
              </div>
            </div>
  
            <div class="col-50">
              <h3>Payment</h3>
              <label for="fname">Accepted Cards</label>
              <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"><img src="https://toppng.com/uploads/preview/visa-card-vector-logo-download-free-11574017205qt0yhmuc5a.png" style='width:180px' alt="visa" /></i>
                <i class="fa fa-cc-discover" style="color:orange;"><img src="https://img2.pngdownload.id/20180821/jpy/kisspng-mastercard-logo-credit-card-maestro-payment-card-mastercard-mastercard-logo-design-vector-free-down-5b7bd9c7c83ef0.9372206915348433358202.jpg" style='width:180px' alt="master card" /></i>
                <i class="fa fa-cc-mastercard" style="color:blue;"><img src="https://img2.pngdownload.id/20180802/yet/kisspng-american-express-logo-credit-card-payment-seo-for-the-finance-industry-experience-and-solu-5b62e8845e9914.5428316515332087083875.jpg" style='width:180px' alt="amex" /></i>
                
              </div>
              <label for="cname">Name on Card</label>
              <input type="text" id="cname" name="cardname" placeholder="John More Doe">
              <label for="ccnum">Credit card number</label>
              <input type="number" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
              <label for="expmonth">Exp Month & Year</label>
              <input type="month" id="expmonth" name="expmonth" placeholder="September">
  
              <div class="row">

                <div class="col-50">
                  <label for="cvv">CVV</label>
                  <input type="number" id="cvv" name="cvv" placeholder="352">
                </div>
              </div>
            </div>
  
          </div>
          <label>
            <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
          </label>
          <input type="submit" value="Continue to pay" class="btn">
        </form>
      </div>
    </div>
  
    <div class="col-25">
      <div class="container">
        <h4>Cart
          <span class="price" style="color:black">
            <i class="fa fa-shopping-cart"></i>
            <b>4</b>
          </span>
        </h4>
        <p><a href="#">Product 1</a> <span class="price">$15</span></p>
        <p><a href="#">Product 2</a> <span class="price">$5</span></p>
        <p><a href="#">Product 3</a> <span class="price">$8</span></p>
        <p><a href="#">Product 4</a> <span class="price">$2</span></p>
        <hr>
        <p>Total <span class="price" style="color:black"><b>$30</b></span></p>
      </div>
    </div>
  </div>
</html>