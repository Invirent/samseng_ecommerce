<?php
    require __DIR__ . '/../connect_database.php';
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location:../index.php");
    }
    else{
        if ($_SESSION['role'] != 'admin') {
            header("Location:../index.php");
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
    <style>
    .background-samsung{
        background-color: rgb(240, 210, 45);
    }
    </style>
    <title>Home</title>
    <script>
        function removeProduct(id){
            var result = confirm("Are you sure you want to remove this item?");
            if(result){
                window.location.href = "delete_product.php?id=" + id;
            }
        }
    </script>
</head>
<body>
    <!-- Navbar -->
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
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
                    $login = "
                    <a href='../html/eric/registrasi.php' style='margin: 1.25em; text-decoration: none; color: black ;'>Registrasi</a>
                    <a class='user-login btn btn-dark' id='user_login' type='button' href='../html/eric/login.php'>Login</a>";
                }else{
                    $login = "<a href='../php/profile_user.php'><i class='fa fa-user-circle-o'></i></a>";
                }

                echo $login;
            ?>
        </div>
    </nav>

    <!-- Content -->
    <div class="content-admin">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Welcome to Admin Page</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                <ul class="list-group list-group-flush">
                                    <a href="admin_page_product.php">
                                        <li class="list-group-item">User Listing</li>
                                    </a>
                                    <a href="admin_page_user.php">
                                        <li class="list-group-item">User Listing</li>
                                    </a>
                                    <a href="admin_add_user.php">
                                        <li class="list-group-item">Add User</li>
                                    </a>
                                    <a href="admin_order_view.php">
                                        <li class="list-group-item">Incoming Order</li>
                                    </a>
                                    <a href="admin_image_editor.php">
                                        <li class="list-group-item">Image Editor</li>
                                    </a>
                                </ul>
                                </div>
                                <div class="col-9">
                                    <h5 class="card-title">Product Listing</h5>
                                    <table class="table">
                                        <theader>
                                            <tr class="table-warning">
                                                <th>Username</th>
                                                <th>Name</th>
                                                <th>Access Right</th>
                                                <th>Address</th>
                                                <th></th>
                                            </tr>
                                        </theader>
                                        <tbody class="table">
<?php
    $conn = connectLocalDb();
    $sql = "
    SELECT 
    user_login.id as user_id,
    user_login.username as username,
    user_login.access_right as access_right,
    user_login.name as name,
    user_login.address as address
    FROM user_login
    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr class='table table-hover table-striped'>
                <td>".$row['username']."</td>
                <td>".$row['name']."</td>
                <td>".$row['access_right']."</td>
                <td>".$row['address']."</td>
                <td>
                    <a href='edit_user_admin.php?user_id=".$row['user_id']."&edit=1'><i class='fa fa-pencil'></i></a>
                    <a href='#' onclick=removeProduct(".$row['user_id'].")><i class='fa fa-trash'></i></a>
                </td>
            </tr>";
        }
    }
?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
            </div>
        </div>
    </footer>
</body>
</html>