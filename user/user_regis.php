<?php
include('../includes/connect.php');
include('../functions/common_func.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bún đậu Ông Chú - Đăng ký tài khoản</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
        crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="../stylesuper.css">
    <style>
        .user-container {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }
        .btn-primary-custom {
            background-color: rgb(179, 85, 7);
            border-color: rgb(179, 85, 7);
            width: 100%;
        }
        .btn-primary-custom:hover {
            background-color: rgb(150, 70, 5);
            border-color: rgb(150, 70, 5);
        }
    </style>
</head>

<body>

    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary color-navbar navbar-fixed">
            <div class="container-fluid container-fluid_nav">
                <img class="logo-navbar" src="../images/logo.png" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_allproducts.php">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php">Giỏ Hàng</a>
                        </li>
                        <li class="nav-item">
                            <a href="../cart.php" class="nav-link"><i class="fa-solid fa-cart-shopping"></i><sup><?php display_cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Total Price: <?php get_total_price(); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" action="../search_product.php" method="get">
                        <input name="search_data" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <input type="submit" name="search_data_product" class="btn btn-outline-success" value="Search">
                    </form>
                </div>
            </div>
        </nav>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                if(isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='#'>Chào mừng " . $_SESSION['username'] . "</a>
                          </li>
                          <li class='nav-item'>
                            <a class='nav-link' href='../logout.php'>Đăng xuất</a>
                          </li>";
                } else {
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='#'>Chào mừng khách</a>
                          </li>
                          <li class='nav-item'>
                            <a class='nav-link' href='user_login.php'>Đăng nhập</a>
                          </li>
                          <li class='nav-item'>
                            <a class='nav-link' href='user_regis.php'>Đăng ký</a>
                          </li>";
                }
                ?>
            </ul>
        </nav>

        <!-- User Registration Form -->
        <div class="user-container">
            <div class="form-container">
                <h4 class="text-center mb-4">Đăng ký tài khoản</h4>
                <?php
                if(isset($_POST['user_register'])) {
                    $user_username = $_POST['user_username'];
                    $user_email = $_POST['user_email'];
                    $user_password = $_POST['user_password'];
                    $conf_user_password = $_POST['conf_user_password'];
                    $user_address = $_POST['user_address'];
                    $user_contact = $_POST['user_contact'];
                    $user_ip = getIPAddress();
                    
                    // Check if username or email exists
                    $select_query = "SELECT * FROM user WHERE username='$user_username' OR user_email='$user_email'";
                    $result = mysqli_query($con, $select_query);
                    $rows_count = mysqli_num_rows($result);
                    
                    if($rows_count > 0) {
                        echo "<script>alert('Tên đăng nhập hoặc email đã tồn tại!')</script>";
                    } else if($user_password != $conf_user_password) {
                        echo "<script>alert('Mật khẩu xác nhận không khớp!')</script>";
                    } else {
                        // Hash password
                        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
                        
                        // Insert user
                        $insert_query = "INSERT INTO user (username, user_email, user_password, user_ip, user_address, user_mobile) 
                                       VALUES ('$user_username', '$user_email', '$hash_password', '$user_ip', '$user_address', '$user_contact')";
                        $sql_execute = mysqli_query($con, $insert_query);
                        
                        if($sql_execute) {
                            echo "<script>alert('Đăng ký thành công!')</script>";
                            echo "<script>window.open('user_login.php','_self')</script>";
                        } else {
                            die("Error: " . mysqli_error($con));
                        }
                    }
                }
                // selecting cart items
                $select_cart_items = "SELECT * FROM cart WHERE ip_address='$user_ip'";
                $result_cart_items = mysqli_query($con, $select_cart_items);
                $rows_count_cart = mysqli_num_rows($result_cart_items);
                if($rows_count_cart > 0) {
                    $_SESSION['username'] = $user_username; // Set session variable
                    echo "<script>alert('Bạn có sản phẩm trong giỏ hang')</script>";
                    echo "<script>window.open('checkout.php','_self')</script>";
                }else {
                    echo "<script>window.open('../index.php','_self')</script>";
                }
                ?>
                <form action="" method="post">
                    <div class="form-outline mb-3">
                        <label for="user_username" class="form-label">Tên đăng nhập</label>
                        <input type="text" id="user_username" class="form-control" 
                               placeholder="Nhập tên đăng nhập" name="user_username" autocomplete="off" required>
                    </div>
                    
                    <div class="form-outline mb-3">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" class="form-control" 
                               placeholder="Nhập email" name="user_email" autocomplete="off" required>
                    </div>
                    
                    <div class="form-outline mb-3">
                        <label for="user_password" class="form-label">Mật khẩu</label>
                        <input type="password" id="user_password" class="form-control" 
                               placeholder="Nhập mật khẩu" name="user_password" required>
                    </div>
                    
                    <div class="form-outline mb-3">
                        <label for="conf_user_password" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" id="conf_user_password" class="form-control" 
                               placeholder="Nhập lại mật khẩu" name="conf_user_password" required>
                    </div>
                    
                    <div class="form-outline mb-3">
                        <label for="user_address" class="form-label">Địa chỉ</label>
                        <input type="text" id="user_address" class="form-control" 
                               placeholder="Nhập địa chỉ" name="user_address" autocomplete="off" required>
                    </div>
                    
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Số điện thoại</label>
                        <input type="text" id="user_contact" class="form-control" 
                               placeholder="Nhập số điện thoại" name="user_contact" autocomplete="off" required>
                    </div>
                    
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Đăng ký" class="btn btn-primary-custom py-2" name="user_register">
                    </div>
                    
                    <p class="small fw-bold mt-2 pt-1 mb-0 text-center">
                        Đã có tài khoản? <a href="user_login.php" class="text-danger">Đăng nhập ngay</a>
                    </p>
                </form>
            </div>
        </div>

        <!-- last child -->
        <?php include('../includes/footer.php'); ?>
    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous">
    </script>
</body>

</html>