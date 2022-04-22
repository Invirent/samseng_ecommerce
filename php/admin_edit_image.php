<?php
    require __DIR__ . '/../connect_database.php';
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
        $login = "<a href='../php/profile_user.php'><i class='fa fa-user-circle-o'></i></a>";
        if (($_SESSION['role'] == 'admin')) {
            $upload = "<a href='add_user_admin.php'>
            <button>Add User</button></a>";
        }
    }
    echo $upload;
    echo $login;
?> 
        </div>
    </nav>

    <div clas="form-width">
        <h1>Edit User</h1>
<?php
    $connect = connectLocalDb();
    $id = $_GET['image_id'];
    $query = "SELECT 
    image_editor.id as image_id,
    image_editor.image_path as image_path,
    image_editor.location as location,
    image_editor.html_id as html_id
    FROM image_editor WHERE id = $id";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    $image_id = $row['image_id'];
    $image_path = $row['image_path'];
    $location = $row['location'];
    $html_id = $row['html_id'];


    $html = "
        <form action='edit_image_function.php' method='POST'>
        <table class='table'>
            <tr>
                <th class='border'>Image<br>
                *(Hanya Masukan Apabila ingin mengganti gambar)</th>
                <td class='border'>
                    <input type='file' class='form-control'
                    name='image'>
                </td>
            </tr>
            <tr>
                <th class='border'>Location</th>
                <td class='border'>
                    <input type='text' class='form-control'
                    name='location' value='$location' required>
                </td>
            </tr
            <tr>
                <th class='border'>Html ID</th>
                <td class='border'>
                    <input class='form-control' type='text' name='html_id' value='$html_id'>
                </td>
            </tr>
            <tr>
                <th class='border'>
                    <input type='hidden' name='image_id' value='$image_id'>
                </th>
                <th class='border'>
                    <button class='text-right' type='submit' name='submit' value='Save'>Save</button>
                </th>
            </tr>
        </table>
        </form>
    </div>
    ";
    echo $html;
?>

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