<?php
include('./includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bún đậu Ông Chú</title>
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
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary color-navbar navbar-fixed">
            <div class="container-fluid container-fluid_nav">
                <img class="logo-navbar" src="./images/logo.png" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Đặt món</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>

                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Wekcome Guest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Register</a>
                </li>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center p-3">Bún đậu Ông Chú</h3>
            <p class="text-center">Chuyên cung cấp các món bún đậu truyền thống Việt Nam</p>
        </div>

        <!-- fourth child -->
        <div class="row px-3">
            <!-- Sản phẩm -->
            <div class="col-md-10">
                <div class="row">
                    <?php
                    $select_products = "SELECT * FROM products ORDER BY RAND() LIMIT 0,6";
                    $result_products = mysqli_query($con, $select_products);
                    while ($row_products = mysqli_fetch_array($result_products)) {
                        $product_title = $row_products['product_title'];
                        $product_desc = $row_products['product_desc'];
                        $product_price = $row_products['product_price'];
                        $product_image = $row_products['product_image'];
                        $cate_id = $row_products['cate_id'];

                        echo "
                <div class='col-md-4 mb-4'>
                    <div class='card h-100 shadow-sm'>
                        <img src='./images/$product_image' class='card-img-top' alt='$product_title'>
                        <div class='card-body d-flex flex-column'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text small text-muted'>$product_desc</p>
                            <p class='fw-bold text-danger'>Giá: " . number_format($product_price) . " VNĐ</p>
                            <div class='mt-auto'>
                                <a href='#' class='btn btn-sm btn-primary'>Thêm vào giỏ hàng</a>
                                <a href='index.php?category=$cate_id' class='btn btn-sm btn-outline-secondary'>Thông tin</a>
                            </div>
                        </div>
                    </div>
                </div>
                ";
                    }
                    ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-2 bg-secondary p-0">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item" style="background-color:rgb(179, 85, 7) !important;">
                        <a href="#" class="nav-link text-light text-center py-2">
                            <h5 class="mb-0">🍽 MENU</h5>
                        </a>
                    </li>
                    <?php
                    $select_categories = "SELECT * FROM `categories`";
                    $result_categories = mysqli_query($con, $select_categories);
                    while ($row_categories = mysqli_fetch_assoc($result_categories)) {
                        $cate_title = $row_categories['cate_title'];
                        $cate_id = $row_categories['cate_id'];
                        echo "<li class='nav-item'>
                        <a href='index.php?category=$cate_id' class='nav-link text-light'>$cate_title</a>
                      </li>";
                    }
                    ?>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🍜 Bún đậu thập cẩm</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🥩 Chả cốm, chả cua</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🧈 Đậu rán</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🐷 Lòng heo</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🍖 Thịt luộc</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🥤 Nước uống</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🍢 Ăn vặt khác</a></li>
                </ul>
            </div>
        </div>

        <!-- last child -->
        <!-- <div class="bg-info p-3 text-center">
        <p class="text-light">© 2025 Bún đậu Ông Chú. All rights reserved.</p>
        <p class="text-light">Designed by <a href="" class="text-light">Your Name</a></p>
    </div> -->

    </div>






    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous">
    </script>
</body>

</html>