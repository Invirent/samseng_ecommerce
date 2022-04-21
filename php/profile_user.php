<?php 
    session_start();
    $variabel_username = $_SESSION["username"];
    $variabel_id = $_SESSION["user_id"];
    $variabel_role = $_SESSION["role"];
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
    <title>User Profile</title>
    <style>
        body{
            background-image:url("../static/img/laundry.png");
            font-size:1.5rem;
        }
        div{
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            border: 5px solid black;
            background: white;
            padding:1.2em;
        }
        .left{
            text-align:left;
        }
        a{
            text-decoration:none;
        }
        a:visited{
            color:blue;
        }
        a:hover{
            color:red;
        }
    </style>
</head>
<body>
    <div>
        <a href="../index.php" class="left"><button type="button" class="btn-close" aria-label="Close"></button></a>
        <br>
        <h1>User Profile</h1>
        <?php 
            if ($variabel_role == "admin"){
                $admin_page = "<a href='admin_page_product.php'>Go to Admin Page</a>";
            }
            else{
                $admin_page = "";
            }
            echo "<table class='table-form'>
                    <tr>
                        <td>
                            ID : $variabel_id
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Username : $variabel_username
                        </td>
                    </tr>
                    </table>
                    <br>
                    $admin_page    
                    <a href='../html/eric/logout.php'>Log Out</a> ";
        ?>
    </div>
</body>
</html>