<?php
include('./includes/connect.php');
include('./functions/common_func.php');
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
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="stylesuper.css">

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
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_allproducts.php">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Giỏ Hàng</a>
                        </li>
                        <li class="nav-item">
                            <a href="cart.php" class="nav-link"><i class="fa-solid fa-cart-shopping"></i><sup><?php display_cart_item();
                                                                                                                ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Total Price: <?php get_total_price(); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>

                    </ul>
                    <form class="d-flex" role="search" action="search_product.php" method="get">
                        <input name="search_data" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                        <input type="submit" name="search_data_product" class="btn btn-outline-success" value="Search">
                    </form>
                </div>
            </div>
        </nav>

        <!-- cart function -->
        <?php
        if (isset($_GET['add_to_cart'])) {
            $product_id = $_GET['add_to_cart'];
            addToCart($product_id);
        }
        ?>
        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Wekcome Guest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./user/user_login.php">Login</a>
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
                    //display products
                    getProducts();
                    get_uni_categories();
                    // $ip = getIPAddress();
                    // echo 'User Real IP Address - ' . $ip;
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
                    // Hiển thị danh sách danh mục
                    getCategories();
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
        <?php include('./includes/footer.php'); ?>

    </div>






    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous">
    </script>
</body>

</html>